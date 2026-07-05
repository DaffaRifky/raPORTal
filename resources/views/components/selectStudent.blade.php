{{-- resources/views/components/select-student.blade.php --}}

@props([
    'name'           => 'select',
    'items'          => [],
    'valueField'     => 'id',
    'labelField'     => 'name',
    'selected'       => null,
    'placeholder'    => 'Select...',
    'submitOnSelect' => false,   // ← NEW: auto-submit parent form on pick
])

<div
    x-data="searchableSelect({
        items:           @js($items),
        selected:        @js($selected),
        valueField:      @js($valueField),
        labelField:      @js($labelField),
        submitOnSelect:  @js($submitOnSelect),
    })"
    x-on:click.outside="open = false"
    class="relative w-full"
>
    {{-- Hidden input submitted with the form --}}
    <input type="hidden" name="{{ $name }}" :value="selectedValue">

    {{-- Trigger / search box --}}
    <div
        @click="toggle()"
        class="flex items-center justify-between w-full px-4 py-2.5 bg-white border rounded-lg cursor-pointer transition
               border-gray-300 hover:border-gray-400"
        :class="open ? 'ring-2 ring-sky-200 border-sky-400' : ''"
    >
        <input
            x-ref="search"
            x-model="query"
            @click.stop="open = true"
            @keydown.escape="open = false"
            @keydown.down.prevent="highlightNext()"
            @keydown.up.prevent="highlightPrev()"
            @keydown.enter.prevent="selectHighlighted()"
            type="text"
            autocomplete="off"
            class="w-full outline-none text-sm text-gray-700 placeholder-gray-700 bg-transparent"
            :placeholder="selectedLabel || '{{ $placeholder }}'"
        >

        <svg class="w-4 h-4 ml-2 text-gray-500 shrink-0 transition-transform duration-200"
             :class="open ? 'rotate-180' : ''"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

    {{-- Dropdown list --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-y-95"
        x-transition:enter-end="opacity-100 scale-y-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-y-100"
        x-transition:leave-end="opacity-0 scale-y-95"
        x-cloak
        class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg
               max-h-64 overflow-y-auto origin-top"
    >
        <template x-if="filtered.length === 0">
            <p class="px-4 py-3 text-sm text-gray-400">Tidak ada data.</p>
        </template>

        <template x-for="(item, index) in filtered" :key="item[valueField]">
            <div
                @click="select(item)"
                @mousemove="highlighted = index"
                class="flex items-center px-4 py-2.5 text-sm cursor-pointer"
                :class="highlighted === index ? 'bg-gray-100' : ''"
            >
                <span class="text-xs text-gray-400 w-20 shrink-0" x-text="item[valueField]"></span>
                <span class="text-gray-700" x-text="item[labelField]"></span>
            </div>
        </template>
    </div>
</div>

@once
@push('scripts')
<script>
    function searchableSelect({ items, selected, valueField, labelField, submitOnSelect }) {
        const firstValue = items.length > 0 ? items[0][valueField] : null;

        return {
            items,
            valueField,
            labelField,
            submitOnSelect,
            query: '',
            open: false,
            highlighted: 0,
            selectedValue: selected ?? firstValue,

            get selectedLabel() {
                const found = this.items.find(i =>
                    String(i[this.valueField]) === String(this.selectedValue)
                );
                return found ? found[this.labelField] : '';
            },

            get filtered() {
                if (!this.query) return this.items;
                const q = this.query.toLowerCase();
                return this.items.filter(i =>
                    String(i[this.labelField]).toLowerCase().includes(q) ||
                    String(i[this.valueField]).toLowerCase().includes(q)
                );
            },

            toggle() {
                this.open = !this.open;
                this.highlighted = 0;
                if (this.open) this.$nextTick(() => this.$refs.search.focus());
            },

            select(item) {
                this.selectedValue = item[this.valueField];
                this.query = '';
                this.open = false;

                // Auto-submit the parent <form> when a student is picked
                if (this.submitOnSelect) {
                    this.$nextTick(() => this.$el.closest('form')?.submit());
                }
            },

            highlightNext() {
                this.highlighted = Math.min(this.highlighted + 1, this.filtered.length - 1);
            },

            highlightPrev() {
                this.highlighted = Math.max(this.highlighted - 1, 0);
            },

            selectHighlighted() {
                const item = this.filtered[this.highlighted];
                if (item) this.select(item);
            },
        };
    }
</script>
@endpush
@endonce
