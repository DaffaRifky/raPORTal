@props(['href' => '#'])

<li class="hover:bg-[#1B394F] rounded-xl">
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'block px-2 py-1 text-white font-medium  flex items-center gap-3 mb-2']) }}>
        {{ $slot }}
    </a>
</li>
