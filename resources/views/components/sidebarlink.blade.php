@props(['href' => '#'])

<li class="bg-[#2D5676] hover:bg-[#1B394F]">
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'block px-4 py-3 text-white font-medium  flex items-center gap-3']) }}>
        {{ $slot }}
    </a>
</li>
