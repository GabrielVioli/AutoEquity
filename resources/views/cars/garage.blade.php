@extends('layouts.main')

@section("title", 'Minha Garagem')

@section('content')

    <div class="bg-gray-50 min-h-screen pb-12">

        <div class="bg-gray-900 pt-12 pb-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-serif font-bold text-white">Painel AutoEquity</h1>
                        <p class="text-gray-400 mt-1">Gestão inteligente do seu patrimônio veicular.</p>
                    </div>

                    <a href="{{ route('home') }}" class="px-6 py-3 bg-emerald-500 text-white font-bold rounded-xl hover:bg-emerald-400 transition flex items-center gap-2 shadow-lg hover:-translate-y-0.5">
                        <ion-icon name="add-outline" class="text-xl"></ion-icon>
                        Adicionar Veículo
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700 relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-10 transform translate-x-2 -translate-y-2">
                            <ion-icon name="wallet" class="text-8xl text-emerald-500"></ion-icon>
                        </div>
                        <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Patrimônio Total</p>
                        <h2 class="text-3xl font-bold text-white mt-2">{{ $totalPatrimonioFormatado }}</h2>
                        <div class="mt-4 flex items-center gap-2 text-emerald-400 text-sm">
                            <ion-icon name="trending-up-outline"></ion-icon>
                            <span>Baseado na FIPE atual</span>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Veículos</p>
                                <h2 class="text-3xl font-bold text-white mt-2">{{ $cars->count() }}</h2>
                            </div>
                            <div class="h-12 w-12 bg-gray-700 rounded-full flex items-center justify-center text-white">
                                <ion-icon name="car-sport" class="text-2xl"></ion-icon>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <p class="text-gray-400 text-sm font-medium uppercase tracking-wider">Maior Ativo</p>
                        @if($carroMaisValioso)
                            <h2 class="text-xl font-bold text-white mt-2 truncate">{{ $carroMaisValioso->modelo }}</h2>
                            <p class="text-gray-500 text-sm">{{ $carroMaisValioso->valor }}</p>
                        @else
                            <h2 class="text-xl font-bold text-gray-500 mt-2">-</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">

            <div class="bg-white p-4 rounded-xl shadow-lg mb-8 flex items-center gap-4 border border-gray-100">
                <ion-icon name="search-outline" class="text-gray-400 text-xl ml-2"></ion-icon>
                <input type="text" id="searchInput" onkeyup="filterGlobal()" placeholder="Filtrar meus carros..." class="w-full outline-none text-gray-700 placeholder-gray-400 bg-transparent">
            </div>

            @if($cars->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($cars as $car)
                        <div class="search-card bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group relative flex flex-col">

                            <div class="h-2 bg-emerald-500 w-full"></div>

                            <div class="p-6 flex-grow">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">{{ $car->marca }}</p>
                                        <h3 class="search-text text-xl font-bold text-gray-900 leading-tight group-hover:text-emerald-600 transition">
                                            {{ $car->modelo }}
                                        </h3>
                                    </div>
                                    <div class="h-10 w-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400">
                                        <ion-icon name="pricetag-outline" class="text-xl"></ion-icon>
                                    </div>
                                </div>

                                <div class="mb-6">
                                    <p class="text-3xl font-bold text-gray-800 tracking-tight">{{ $car->valor }}</p>
                                    <p class="text-xs text-gray-400 mt-1">Ref: {{ $car->mes_referencia }}</p>
                                </div>

                                <div class="flex flex-wrap gap-2 mb-6">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                        {{ $car->ano_modelo }}
                                    </span>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <ion-icon name="water-outline"></ion-icon>
                                        {{ $car->combustivel }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                                <a href="{{ route('dashboard.analise', $car->id) }}" class="flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                                    <ion-icon name="stats-chart"></ion-icon>
                                    Ver Evolução
                                </a>

                                <form action="{{ route('garage.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este carro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition p-2 rounded-full hover:bg-red-50" title="Remover">
                                        <ion-icon name="trash-outline" class="text-xl"></ion-icon>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div id="noResults" class="hidden text-center py-10">
                    <p class="text-gray-400">Nenhum carro encontrado com esse filtro.</p>
                </div>

            @else
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                    <div class="h-20 w-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-300 mb-6">
                        <ion-icon name="car-outline" class="text-5xl"></ion-icon>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Garagem vazia</h2>
                    <p class="text-gray-500 max-w-sm mx-auto mb-8">Adicione veículos para ver a análise financeira do seu patrimônio.</p>

                    <a href="{{ route('home') }}" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition shadow-lg hover:shadow-emerald-200">
                        Pesquisar Veículos
                    </a>
                </div>
            @endif

        </div>
    </div>

@endsection
