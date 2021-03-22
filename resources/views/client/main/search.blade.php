@extends('layouts.two_side_layout')
@section('title')
    Binutrima | Pretraga
@endsection

@section('keywords')
    pretraga,search,traži,binutrima,Binutrima
@endsection

@section('heading_bottom_margin')3 @endsection

@section('description')
    Pretraga za Binutrima sajt
@endsection

@section('heading')
    Pretraga
@endsection

@section('left_side_content')
    <h2 id="searchH2" class="siva">Pretražite po naslovu, kategoriji,  imenu autora ili tekstu</h2>
    <h3 class="mt-4">Rezultati pretrage za '<strong>{{ request()->session()->get('searchValue')}}</strong>'</h3>
    <hr class="mb-4"/>
    @foreach($searchResult as $post)
        @component('client.partial.single_post', ['post' => $post])
        @endcomponent
    @endforeach
    @if($searchResult->isEmpty())
        <div class="alert alert-danger">
            Nažalost nema rezultata za vašu pretragu!
        </div>
    @endif
    <div class="container-fluid d-flex justify-content-center">
        {{ $searchResult->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
