@php
    $navBgImage = $siteSettings['nav_background_image']->value ?? null;
    $siteLogo = $siteSettings['site_logo']->value ?? null;
@endphp

<header 
    class="relative bg-image-cover @if($navBgImage) bg-overlay @endif"
    style="@if($navBgImage) background-image: url('{{ asset('storage/' . $navBgImage) }}') @endif"
>
    <div class="content-over-overlay container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="w-24">
                @if($siteLogo)
                    <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteSettings['site_title']->value ?? 'Site Logo' }}" class="max-h-16">
                @else
                    <span class="font-bold text-lg text-white">{{ $siteSettings['site_title']->value ?? 'Tierra Groove' }}</span>
                @endif
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6">
                @foreach($navigationItems as $item)
                    <a 
                        href="{{ $item->full_url }}"
                        target="{{ $item->is_external ? '_blank' : '_self' }}"
                        class="text-white hover:text-green-300 transition-colors duration-300"
                    >
                        {{ $item->name }}
                    </a>
                @endforeach
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</header> 