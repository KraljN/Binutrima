@extends('layouts.layout')


@section('title')
    Binutrima | Početna Stranica
@endsection

@section('keywords')
    početna,pocetna,home,binutrima,Binutrima

@endsection

@section('description')
    Binutrima - U zdravom telu, zdrav duh
@endsection


@section('content')
        <div class="container">
            <div class="row m-0 mb-5">
                <div class="container-fluid d-flex flex-column flex-lg-row sivaPozadina" id="main">
                    <div class="col-lg-6 mainImage"></div>
                    <div class="col-lg-6 mainTextbox mt-5 mt-sm-0">
                        <p class="mb-3 mb-lg-2 desc">Vrednujte svoje zdravlje</p>
                        <h1 class="mb-4 mb-lg-3 fw-bold">Binutrima - U zdravom telu, zdrav duh</h1>
                        <p>Ovaj blog je posvećen svima vama koji volite vaše telo i želite da unapredite stil svog života.</br> Zračite pozitivnom energijom kao nikad do sad prateći savete sa mog portala.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mt-lg-5 leftContent">
                    <h2 class="text-decoration-underline mb-5">Najnoviji Postovi</h2>
                    @foreach($newestPosts as $post)
                        @component('client.partial.single_post', ['post' => $post])
                        @endcomponent
                    @endforeach


                </div>
                <div class="col-lg-4 mt-4 mt-lg-5" id="mostPopular">
                    <h2 class="text-decoration-underline mb-5">Najpopularniji Postovi</h2>
                    @foreach($mostPopular as $post)
                        @component('client.partial.popular_post', ['post'=>$post, 'loop'=>$loop])
                        @endcomponent
                    @endforeach
                </div>

            </div>
        </div>
@endsection
