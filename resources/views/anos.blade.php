@extends('layouts.main')

@section('title', 'Selecione o Ano')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto mb-12">
                <div class="relative group">
                    <input type="text"
                           id="searchInput"
                           onkeyup="filterGlobal()"
                           placeholder="Pesquise o ano (Ex: 2022)..."
                           class="w-full pl-8 pr-14 py-4 rounded-full border-0 shadow-lg ring-1 ring-gray-100 focus:ring-2 focus:ring-gray-900 text-lg outline-none transition placeholder-gray-400">

                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                        <ion-icon name="search-outline" class="text-2xl text-gray-400 group-focus-within:text-gray-900 transition"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="text-center md:text-left mb-8">
                <h1 class="text-3xl font-serif font-bold text-gray-900">Selecione o Ano</h1>
                <p class="text-gray-500 mt-2" id="countDisplay">{{ count($listaAnos) }} opções encontradas</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="yearsGrid">

                @foreach($listaAnos as $ano)
                    <a href="/detalhes?marca={{ $codigoMarca }}&modelo={{ $codigoModelo }}&ano={{ $ano['codigo'] }}" class="search-item year-card bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group flex items-center justify-between">

                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 group-hover:bg-gray-900 group-hover:text-white transition duration-300">
                                <ion-icon name="calendar-outline" class="text-xl"></ion-icon>
                            </div>

                            <h3 class="search-text font-bold text-lg text-gray-800 group-hover:text-gray-900 year-name">
                                {{ $ano['nome'] }}
                            </h3>
                        </div>

                        <div class="text-gray-300 group-hover:text-gray-900 transition">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </div>
                    </a>
                @endforeach

                <div id="noResults" class="hidden col-span-full text-center py-10">
                    <p class="text-gray-400 text-lg">Nenhum ano encontrado.</p>
                </div>

            </div>
        </div>
    </div>

@endsection
