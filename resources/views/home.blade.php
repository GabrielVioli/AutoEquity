@extends('layouts.main')

@section('title', 'Marcas')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto mb-16 mt-4">
                <div class="relative group">
                    <input type="text"
                           id="searchInput"
                           onkeyup="filterGlobal()"
                           placeholder="Pesquise por uma marca..."
                           class="w-full pl-8 pr-14 py-4 rounded-full border-0 shadow-lg ring-1 ring-gray-100 focus:ring-2 focus:ring-gray-900 text-lg outline-none transition placeholder-gray-400">

                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                        <ion-icon name="search-outline" class="text-2xl text-gray-400 group-focus-within:text-gray-900 transition"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-3">Marcas Disponíveis</h1>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto" id="countDisplay">
                    {{ count($carsMarcas) }} opções encontradas
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($carsMarcas as $car)
                    <a href="/modelos?marca={{$car['codigo'] }}" class="search-item bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col items-center justify-center group hover:-translate-y-1 cursor-pointer h-40">

                        <div class="h-14 w-14 bg-gray-50 rounded-full flex items-center justify-center mb-3 text-gray-400 group-hover:bg-gray-900 group-hover:text-white transition duration-300">
                            <ion-icon name="pricetag-outline" class="text-2xl"></ion-icon>
                        </div>

                        <h3 class="search-text font-bold text-lg text-gray-800 group-hover:text-gray-900 text-center capitalize">
                            {{ $car['nome'] }}
                        </h3>
                    </a>
                @endforeach

                <div id="noResults" class="hidden col-span-full text-center py-10">
                    <p class="text-gray-400 text-lg">Nenhuma marca encontrada.</p>
                </div>

            </div>

        </div>
    </div>

@endsection
