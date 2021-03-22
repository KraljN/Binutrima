@extends ('layouts.two_side_layout')
@section('title')
    Binutrima | {{$category->name}}
@endsection

@section('keywords')
    {{$category->name}},postovi,post,kategorija,binutrima,posts,kategorije,Binutrima
@endsection

@section('heading_bottom_margin')5 @endsection

@section('description')
   Binutrima | {{$category->name}}
@endsection

@section('heading')
    {{$category->name}}
@endsection

@section('left_side_content')
    @foreach($postCategory as $post)
        @component('client.partial.single_post', ['post' => $post])
        @endcomponent
    @endforeach
    <div class="container-fluid d-flex justify-content-center">
        {{ $postCategory->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
