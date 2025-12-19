@extends('layouts.main')

@section('title', 'Detalhes do Veículo')

@section('content')

    <div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:scale-[1.01] duration-500">

            <div class="bg-gray-900 px-8 py-12 text-center relative overflow-hidden group">

                <div class="absolute top-0 left-0 w-full h-full opacity-5 group-hover:opacity-10 transition duration-700">
                    <ion-icon name="pricetag" class="text-[15rem] -rotate-12 translate-x-10 translate-y-10 text-white"></ion-icon>
                </div>

                <div class="relative z-10">
                    <h2 class="text-gray-400 font-medium tracking-widest uppercase text-xs mb-3">Valor Tabela FIPE</h2>

                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight">
                        {{ $veiculo['Valor'] }}
                    </h1>

                    <div class="inline-flex items-center gap-2 bg-gray-800 px-4 py-1.5 rounded-full border border-gray-700">
                        <ion-icon name="calendar-number-outline" class="text-gray-400"></ion-icon>
                        <p class="text-gray-300 text-xs font-medium">Referência: {{ $veiculo['MesReferencia'] }}</p>
                    </div>
                </div>
            </div>

            <div class="px-8 py-10">

                <div class="text-center mb-10 border-b border-gray-100 pb-8">
                    <h3 class="text-2xl md:text-3xl font-serif font-bold text-gray-800 mb-2">
                        {{ $veiculo['Modelo'] }}
                    </h3>
                    <p class="text-gray-500 font-medium">{{ $veiculo['Marca'] }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center text-gray-900 shadow-sm">
                            <ion-icon name="calendar-outline" class="text-2xl"></ion-icon>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Ano do Modelo</p>
                            <p class="text-lg font-bold text-gray-800">{{ $veiculo['AnoModelo'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center text-gray-900 shadow-sm">
                            <ion-icon name="water-outline" class="text-2xl"></ion-icon>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Combustível</p>
                            <p class="text-lg font-bold text-gray-800">{{ $veiculo['Combustivel'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center text-gray-900 shadow-sm">
                            <ion-icon name="qr-code-outline" class="text-2xl"></ion-icon>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Código FIPE</p>
                            <p class="text-lg font-bold text-gray-800">{{ $veiculo['CodigoFipe'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center text-gray-900 shadow-sm">
                            <ion-icon name="text-outline" class="text-2xl"></ion-icon>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Sigla</p>
                            <p class="text-lg font-bold text-gray-800">{{ $veiculo['SiglaCombustivel'] ?? '-' }}</p>
                        </div>
                    </div>

                </div>

                <div class="mt-10 border-t border-gray-100 pt-8">

                    <div class="flex flex-col md:flex-row items-center justify-center gap-4">

                        <a href="{{ route('home') }}" class="w-full md:w-auto px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-medium hover:bg-gray-50 hover:text-gray-900 transition flex items-center justify-center gap-2">
                            <ion-icon name="arrow-back-outline"></ion-icon>
                            Voltar
                        </a>

                        @auth
                            <form action="/garagem" method="POST" class="w-full md:w-auto">
                                @csrf

                                <input type="hidden" name="fipe_codigo" value="{{ $veiculo['CodigoFipe'] }}">
                                <input type="hidden" name="marca" value="{{ $veiculo['Marca'] }}">
                                <input type="hidden" name="modelo" value="{{ $veiculo['Modelo'] }}">
                                <input type="hidden" name="ano_modelo" value="{{ $veiculo['AnoModelo'] }}">
                                <input type="hidden" name="combustivel" value="{{ $veiculo['Combustivel'] }}">
                                <input type="hidden" name="valor" value="{{ $veiculo['Valor'] }}">
                                <input type="hidden" name="mes_referencia" value="{{ $veiculo['MesReferencia'] }}">
                                <input type="hidden" name="sigla_combustivel" value="{{ $veiculo['SiglaCombustivel'] ?? '' }}">

                                <button type="submit" class="w-full md:w-auto px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition shadow-lg hover:shadow-emerald-200 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <ion-icon name="add-circle-outline" class="text-xl"></ion-icon>
                                    Adicionar à Garagem
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="w-full md:w-auto px-8 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <ion-icon name="log-in-outline" class="text-xl"></ion-icon>
                                Login para Salvar
                            </a>
                        @endauth

                    </div>
                </div>

            </div> </div> </div>
@endsection
