@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row m-0" id="left">
            <div class="col-lg-8 mt-lg-5 leftContent" id="category">
                <h1 class="text-decoration-underline mb-@yield("heading_bottom_margin")"> @yield('heading')</h1>
                @yield('left_side_content')
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

