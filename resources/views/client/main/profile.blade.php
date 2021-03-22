@extends('layouts.layout')

@section('title')
    Binutrima | Profil
@endsection

@section('keywords')
    profil,binutrima,profile,nalog,binutrima,Binutrima

@endsection

@section('description')
    Izmeni podatke na svom nalogu.
@endsection

@section('content')

    <div class="container-fluid sivaPozadina">
        <div class="container-fluid formPadding" id="profile">
            <div class="container formPadding">
                <div class="row mb-3"><h1 class="text-decoration-underline mb-3">Upravljaj Nalogom</h1></div>
                <div class="row m-0">
                    <div class="container">
                        @include('client.partial.user_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
