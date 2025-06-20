@extends('layouts.public')

@section('content')
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-center bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white text-center leading-tight">
                    {{ $siteSettings['site_title']->value ?? 'Tierra Groove Festival' }}
                </h1>
            </div>

            <div class="mt-8 text-center">
                <p class="text-lg text-gray-300">
                    {{ $siteSettings['site_description']->value ?? 'Festival de música electrónica en las Grutas de Tolantongo, Hidalgo' }}
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a href="#" class="scale-100 p-6 bg-white/5 bg-opacity-20 backdrop-blur-xl rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="mt-6 text-xl font-semibold text-white">Lineup</h2>
                            <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                                Descubre los artistas que nos acompañarán este año.
                            </p>
                        </div>
                    </a>

                    <a href="#" class="scale-100 p-6 bg-white/5 bg-opacity-20 backdrop-blur-xl rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="mt-6 text-xl font-semibold text-white">Comprar Boletos</h2>
                            <p class="mt-4 text-gray-400 text-sm leading-relaxed">
                                Asegura tu lugar en la experiencia Tierra Groove. ¡No te quedes fuera!
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
