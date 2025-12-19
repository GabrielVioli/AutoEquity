@extends('layouts.main')

@section('title', 'Welcome')

@section('content')

    <section class="lg:min-h-[90vh] flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-20 bg-white overflow-hidden py-12 lg:py-0 gap-12 lg:gap-0">

        <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left z-10">

            <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-gray-900 mb-6 leading-tight tracking-tight max-w-xl">
                Domine o Valor Financeiro do seu Veículo
            </h1>

            <p class="font-sans text-lg text-gray-600 mb-8 leading-relaxed max-w-md mx-auto lg:mx-0">
                Acompanhe a flutuação da Tabela FIPE em tempo real e receba insights estratégicos para saber
                exatamente a hora de vender ou trocar seu veículo.
            </p>

            <div class="flex justify-center lg:justify-start w-full">
                <a href="/register" class="inline-flex items-center justify-center bg-gray-900 text-white px-10 py-4 rounded-xl font-medium tracking-wide hover:bg-gray-800 transition shadow-lg text-lg hover:-translate-y-0.5">
                    Começar agora
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex justify-center lg:justify-end relative mt-4 lg:mt-0">

            <img src="{{ asset('images/carro.png') }}"
                 alt="Veículo Premium"
                 class="w-[100%] max-w-md lg:max-w-3xl h-auto object-contain drop-shadow-2xl">

        </div>

    </section>

@endsection
