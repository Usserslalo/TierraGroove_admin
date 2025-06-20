@extends('admin.layouts.app')

@section('title', 'Configuraciones del Sitio')

@section('header', 'Configuraciones del Sitio')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Configuraciones Generales</h3>
            <form action="{{ route('admin.site-settings.initialize') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg" onclick="return confirm('¿Estás seguro? Esto reseteará las configuraciones a sus valores por defecto.')">
                    <i class="fas fa-magic mr-2"></i>Inicializar/Resetear
                </button>
            </form>
        </div>
    </div>

    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        @foreach($settings as $group => $groupSettings)
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4 capitalize border-b pb-2">{{ str_replace('_', ' ', $group) }}</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($groupSettings as $setting)
                        <div class="space-y-2">
                            <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                {{ $setting->description ?: ucfirst(str_replace('_', ' ', $setting->key)) }}
                            </label>
                            
                            @if($setting->type === 'textarea')
                                <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 preview-input"
                                    data-preview-target="#preview-{{ $setting->key }}"
                                >{{ old($setting->key, $setting->value) }}</textarea>

                            @elseif($setting->type === 'image')
                                <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 preview-input"
                                    data-preview-target="#preview-bg-{{ $setting->key }}" data-preview-type="background">
                                @if($setting->value)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $setting->value) }}" alt="Imagen actual" class="w-48 h-auto rounded-lg shadow-md">
                                        <p class="text-xs text-gray-500 mt-1">Imagen actual. Sube una nueva para reemplazarla.</p>
                                    </div>
                                @endif

                            @else
                                <input type="{{ $setting->type }}" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                                    value="{{ old($setting->key, $setting->value) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 preview-input"
                                    data-preview-target="#preview-{{ $setting->key }}">
                            @endif
                            
                            @error($setting->key)
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i>Guardar Configuraciones
            </button>
        </div>
    </form>
</div>

<!-- Live Previews -->
<div class="mt-8 space-y-8">
    <!-- Header Preview -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Vista Previa de la Navegación</h3>
        </div>
        <div class="p-6">
            @php
                $navBgImage = \App\Models\SiteSetting::get('nav_background_image');
                $siteLogo = \App\Models\SiteSetting::get('site_logo');
                $navigationItems = \App\Models\NavigationItem::active()->ordered()->get();
            @endphp
            <header 
                id="preview-bg-nav_background_image"
                class="relative bg-gray-800 bg-cover bg-center text-white rounded-lg overflow-hidden @if($navBgImage) bg-overlay @endif"
                style="@if($navBgImage) background-image: url('{{ asset('storage/' . $navBgImage) }}') @endif"
            >
                <div class="content-over-overlay container mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <a href="#" id="preview-logo-wrapper" class="w-24">
                             @if($siteLogo)
                                <img src="{{ asset('storage/' . $siteLogo) }}" id="preview-site_logo" alt="Logo Preview" class="max-h-16">
                            @else
                                <span class="font-bold text-lg text-white" id="preview-site_title">{{ \App\Models\SiteSetting::get('site_title', 'Tierra Groove') }}</span>
                            @endif
                        </a>
                        <nav class="hidden md:flex items-center space-x-6">
                            @foreach($navigationItems as $item)
                                <span class="hover:text-green-300">{{ $item->name }}</span>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </header>
        </div>
    </div>

    <!-- Footer Preview -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-medium text-gray-900">Vista Previa del Footer</h3>
        </div>
        <div class="p-6">
            @php
                $footerBgImage = \App\Models\SiteSetting::get('footer_background_image');
                $socialLinks = \App\Models\SocialLink::active()->ordered()->get();
            @endphp
            <footer
                id="preview-bg-footer_background_image"
                class="relative bg-gray-900 bg-cover bg-center text-white p-6 rounded-lg @if($footerBgImage) bg-overlay @endif"
                style="@if($footerBgImage) background-image: url('{{ asset('storage/' . $footerBgImage) }}') @endif"
            >
                <div class="content-over-overlay container mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left mb-6">
                        <!-- Description -->
                        <div>
                            <h4 class="text-lg font-semibold mb-3" id="preview-site_title_footer">{{ \App\Models\SiteSetting::get('site_title', 'Tierra Groove') }}</h4>
                            <p class="text-gray-300 text-sm" id="preview-footer_description">
                                {{ \App\Models\SiteSetting::get('footer_description', 'Festival de música electrónica...') }}
                            </p>
                        </div>
                        
                        <!-- Contact -->
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Contacto</h4>
                            <div class="space-y-2 text-sm text-gray-300">
                                <p><i class="fas fa-envelope mr-2"></i><span id="preview-contact_email">{{ \App\Models\SiteSetting::get('contact_email', 'info@tierragroove.com.mx') }}</span></p>
                                <p><i class="fas fa-phone mr-2"></i><span id="preview-contact_phone">{{ \App\Models\SiteSetting::get('contact_phone', '+52 55 1234 5678') }}</span></p>
                            </div>
                        </div>
                        
                        <!-- Social -->
                        <div>
                            <h4 class="text-lg font-semibold mb-3">Síguenos</h4>
                            <div class="flex space-x-3">
                                @foreach($socialLinks as $social)
                                    <span class="text-2xl" style="color: {{ $social->display_color }}"><i class="{{ $social->icon }}"></i></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-700 pt-6 text-center">
                        <p class="text-sm text-gray-400" id="preview-copyright_text">
                            {{ \App\Models\SiteSetting::get('copyright_text', '© 2025 Tierra Groove. Todos los derechos reservados.') }}
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<style>
.bg-overlay::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 1;
}
.content-over-overlay {
    position: relative;
    z-index: 2;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.preview-input');

    // Function to update logo preview
    function updateLogoPreview(src) {
        const wrapper = document.querySelector('#preview-logo-wrapper');
        let img = document.querySelector('#preview-site_logo');
        
        // If img doesn't exist, create it
        if (!img) {
            wrapper.innerHTML = ''; // Clear text
            img = document.createElement('img');
            img.id = 'preview-site_logo';
            img.alt = 'Logo Preview';
            img.className = 'max-h-16';
            wrapper.appendChild(img);
        }
        
        img.src = src;
    }

    inputs.forEach(input => {
        // Initial sync for elements
        if (input.id === 'site_title') {
            const footerTitle = document.querySelector('#preview-site_title_footer');
            if(footerTitle) footerTitle.innerText = input.value;
        }

        input.addEventListener('input', function() {
            const targetSelector = this.dataset.previewTarget;
            const targetElement = document.querySelector(targetSelector);

            if (targetElement) {
                 if (this.dataset.previewType === 'background') {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            targetElement.style.backgroundImage = `url('${e.target.result}')`;
                            targetElement.classList.add('bg-overlay');
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                } else if (this.id === 'site_logo') {
                     if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            updateLogoPreview(e.target.result);
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                } else {
                    targetElement.innerText = this.value;
                }
            }
            
            // Special handling for site_title to update both header and footer preview
            if (this.id === 'site_title') {
                const footerTitle = document.querySelector('#preview-site_title_footer');
                if(footerTitle) footerTitle.innerText = this.value;
            }
        });
    });
});
</script>
@endsection 