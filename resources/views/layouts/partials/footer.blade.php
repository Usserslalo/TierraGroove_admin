@php
    $footerBgImage = $siteSettings['footer_background_image']->value ?? null;
    $copyrightText = $siteSettings['copyright_text']->value ?? '© 2025 Tierra Groove. Todos los derechos reservados.';
@endphp

<footer
    class="relative bg-image-cover @if($footerBgImage) bg-overlay @endif py-8"
    style="@if($footerBgImage) background-image: url('{{ asset('storage/' . $footerBgImage) }}') @endif"
>
    <div class="content-over-overlay container mx-auto px-6 text-center text-white">
        <!-- Social Links -->
        <div class="flex justify-center space-x-6 mb-4">
            @foreach($socialLinks as $link)
                <a 
                    href="{{ $link->url }}" 
                    target="_blank" 
                    class="text-2xl hover:opacity-75 transition-opacity"
                    style="color: {{ $link->color ?? 'white' }}"
                    aria-label="{{ $link->name }}"
                >
                    <i class="{{ $link->icon }}"></i>
                </a>
            @endforeach
        </div>

        <!-- Copyright -->
        <p class="text-sm text-gray-300">{{ $copyrightText }}</p>
    </div>
</footer> 