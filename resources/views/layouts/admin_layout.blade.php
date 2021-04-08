@extends('layouts.layout')

@section('content')
    <div class="container" id="adminPanel">
        <div class="row">
            <div class="col-md-2 px-lg-5">
                @include('fixed.admin_navigation')
            </div>
            <div class="col-md-10 text-center">
                @yield('admin_content')
            </div>
        </div>
    </div>
@endsection
