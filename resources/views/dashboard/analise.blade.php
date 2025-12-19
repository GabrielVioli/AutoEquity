@extends('layouts.main')

@section('title', 'Análise de Valorização')

@section('content')

    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('garage.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-900 transition">
                    <ion-icon name="arrow-back-outline"></ion-icon> Voltar para Garagem
                </a>
                <span class="px-4 py-1 bg-gray-200 rounded-full text-xs font-bold text-gray-600 uppercase">
                Código Fipe: {{ $car->fipe_codigo }}
            </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 text-center relative overflow-hidden">
                        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-2">Valor Atual de Mercado</p>
                        <h1 class="text-4xl font-extrabold text-gray-900">R$ {{ number_format($precoAtual, 2, ',', '.') }}</h1>

                        <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 rounded-xl {{ $variacao >= 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                            <ion-icon name="{{ $variacao >= 0 ? 'trending-up' : 'trending-down' }}" class="text-xl"></ion-icon>
                            <span class="font-bold text-lg">{{ number_format(abs($porcentagem), 2, ',', '.') }}%</span>
                            <span class="text-sm opacity-80">no último mês</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <ion-icon name="car-sport-outline"></ion-icon> Sobre o Veículo
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between border-b border-gray-50 pb-2">
                                <span class="text-gray-500">Modelo</span>
                                <span class="font-medium text-right w-1/2">{{ $car->modelo }}</span>
                            </div>
                            <div class="flex justify-between border-b border-gray-50 pb-2">
                                <span class="text-gray-500">Ano Modelo</span>
                                <span class="font-medium">{{ $car->ano_modelo }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Combustível</span>
                                <span class="font-medium">{{ $car->combustivel }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl p-6 shadow-lg border border-gray-100 h-full">
                        <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <ion-icon name="analytics-outline"></ion-icon> Histórico de Preços (Últimos 12 meses)
                        </h3>

                        <div class="relative h-[400px] w-full">
                            <canvas id="priceChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('priceChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                // Labels vindas do PHP (Meses)
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Valor FIPE (R$)',
                    // Dados vindos do PHP (Preços)
                    data: {!! json_encode($data) !!},
                    borderWidth: 3,
                    borderColor: '#4F46E5', // Cor da linha (Indigo)
                    backgroundColor: 'rgba(79, 70, 229, 0.1)', // Cor do preenchimento embaixo
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4F46E5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Deixa a linha curva (suave)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Esconde a legenda padrão
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false, // O gráfico começa perto do valor do carro, não do zero
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                return 'R$ ' + value / 1000 + 'k'; // Formata eixo Y (Ex: 50k)
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

@endsection
