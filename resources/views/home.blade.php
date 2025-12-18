@extends('layouts.main')


@section('title', 'Home')

    @section('content')

        <section>
            <div class="search">
                <input type="text" name="search" id="search" placeholder="pesquise aqui">
                <img src="(pegue um icone da internet e coloque aqui)" alt="pesquisar">
            </div>
        </section>

        <section>
            <div>
                <h1>Todos os carros</h1>
                <p>Veja todos os carros(escreva algo legal aqui)</p>

                <section class="container-cards">
                    @foreach($cars as $car) {
                        <p>{{$car['nome']}}</p>
                    @endforeach
                </section>
            </div>
        </section>


    @endsection
