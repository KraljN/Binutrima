@extends('layouts.layout')

@section('title')
    Binutrima | Stranica Za Prijavu / Registraciju
@endsection

@section('keywords')
    login,register,prijava,registracija,binutrima,Binutrima
@endsection

@section('description')
    Stranica na kojoj se možete prijaviti na Vaš nalog, kao i napraviti novi.
@endsection

@section('content')

<div class="container-fluid sivaPozadina">
    <div class="container" id="authentication">
        <div class="row">
            <h1 class="text-decoration-underline mb-4 pt-3">Prijavi se</h1>
        </div>
        <form class="row g-3 pb-5" method="POST" action="{{route('login')}}">
            <div class="col-md-6">
                <label for="usernameLog" class="form-label ms-2">Korisničko Ime</label>
                <input type="text" class="form-control zaobljeno" id="usernameLog"/>
                <span class="text-danger ms-sm-2"></span>

            </div>
            <div class="col-md-6">
                <label for="passLog" class="form-label ms-2">Lozinka</label>
                <input type="password" class="form-control zaobljeno" id="passLog"/>
                <span class="text-danger ms-sm-2"></span>
            </div>
            <div class="alert alert-danger m-0 info" id="errorLog">
                Pogrešna šifra ili korisničko ime
            </div>
            <div class="col-12">
                <button type="submit" id="login" class="btn bg-dark zaobljeno text-white zelelnaPrevlaka">Prijavi se</button>
            </div>
        </form>
        <div class="row">
            <h1 class="text-decoration-underline mb-4">Registruj se</h1>
        </div>
        <form method="POST" action="{{route('register')}}" class="row g-3 pb-5">
            <div class="col-md-6">
                <label for="ime" class="form-label ms-2">Ime</label>
                <input type="text" class="form-control zaobljeno" id="ime"/>
                <span class="text-danger ms-sm-2"></span>
            </div>
            <div class="col-md-6">
                <label for="prezime" class="form-label ms-2">Prezime</label>
                <input type="text" class="form-control zaobljeno" id="prezime"/>
                <span class="text-danger ms-sm-2"></span>

            </div>
            <div class="col-md-6">
                <label for="username" class="form-label ms-2">Korisničko Ime</label>
                <input type="text" class="form-control zaobljeno" id="username"/>
                <span class="text-danger ms-sm-2"></span>

            </div>
            <div class="col-md-6">
                <label for="pass" class="form-label ms-2">Lozinka</label>
                <input type="password" class="form-control zaobljeno" id="pass"/>
                <span class="text-danger ms-sm-2"></span>

            </div>
            <div class="col-12">
                <label for="email" class="form-label ms-2">Email</label>
                <input type="email" class="form-control zaobljeno" id="email"/>
                <span class="text-danger ms-sm-2"></span>

            </div>
            <div class="alert alert-danger m-0 info" id="errorReg">
                Korisnik sa ovim korisničkim imenom već postoji!
            </div>
            <div class="alert alert-success m-0 info" id="successReg">
                Uspešno napravljen nalog!
            </div>
            <div class="col-12">
                <button type="submit" id="register"class="btn bg-dark zaobljeno text-white zelelnaPrevlaka">Registruj se</button>
            </div>
        </form>
    </div>
</div>

@endsection
