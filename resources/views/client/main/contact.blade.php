@extends('layouts.layout')

@section('title')
    Binutrima | Kontaktirajte nas
@endsection

@section('keywords')
    contact us, kontakt, kontaktirajte nas,contact,binutrima,Binutrima
@endsection

@section('description')
    Stranica za kontaktiranje administracije Binutrima bloga.
@endsection


@section('content')
    <div class="container-fluid sivaPozadina">
        <div class="container formPadding" id="contact">
            <div class="row">
                <h1 class="text-decoration-underline mb-4">Kontaktirajte nas</h1>
            </div>
            <div class="row">
                <form method="POST" action="{{route('contact.sendEmail')}}" class="row g-3 pb-5">
                    <div class="col-md-6 mt-0">
                        <label for="nameContact" class="form-label ms-2">Ime</label>
                        <input type="text" class="form-control zaobljeno" name="nameContact" id="nameContact"/>
                        <span class="text-danger ms-sm-2"></span>
                    </div>
                    <div class="col-md-6 mt-0">
                        <label for="emailContact" class="form-label ms-2">Email</label>
                        <input type="text" class="form-control zaobljeno" name="emailContact" id="emailContact"/>
                        <span class="text-danger ms-sm-2"></span>
                    </div>
                    <div class="col-12 mt-0">
                        <label for="subject" class="form-label ms-2">Naslov</label>
                        <input type="text" class="form-control zaobljeno" name="subject" id="subject"/>
                        <span class="text-danger ms-sm-2"></span>

                    </div>

                    <div class="col-12 mt-0">
                        <label for="message" class="form-label ms-2">Poruka</label>
                        <textarea class="form-control zaobljeno" name="message" id="message" rows="3"></textarea>
                        <span class="text-danger ms-sm-2"></span>
                    </div>
                    <div class="alert alert-danger mb-3 info" id="errorSubmit">
                        Došlo je do greške prilikom slanja poruke, molimo pokušajte kasnije.
                    </div>
                    <div class="alert alert-success mb-3 info" id="successSubmit">
                        Vaša poruka je prosleđena svim administratorima.
                    </div>
                    <div class="col-12 mt-0">
                        <button type="submit" id="submitMessage"class="btn bg-dark zaobljeno text-white zelelnaPrevlaka">Pošalji</button>
                    </div>
            </div>
        </div>
        <div class="position-fixed shadow d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#modalAbout" id="autor"><i class="fas fa-address-card zelena"></i></div>
        <section>
            <div class="modal fade" tabindex="-1" role="dialog" id="modalAbout" pr-0 aria-hidden="true">
                <div class="modal-dialog modalSirina" role="document">
                    <div class="modal-content h-100">
                        <div class="row">
                            <div class="model-body px-5 pt-1 pb-5">
                                <div id="about" class="col-12">
                                    <div class="row text-center d-block mt-3">
                                        <h3>About me</h3>
                                        <hr class="w-25 mt-2 mb-3 mx-auto"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-10 col-sm-5 mx-auto">
                                            <img src="{{asset('assets/img/autor.jpg')}}" alt="autor" class="img-fluid rounded"/>
                                        </div>
                                        <div class="col-10 col-sm-7 d-flex mx-auto align-items-center justify-content-center">
                                            <ul id='info' class="p-0 m-0 list-unstyled">
                                                <li class="mb-3 mt-3 mt-sm-0">Ime: Nikola Kralj</li>
                                                <li class="my-3">Email: nikolakralj9@gmail.com</li>
                                                <li class="my-3">Broj indeksa: 76/18</li>
                                                <li class="my-3">Godina studija: Treća</li>
                                                <li class="mt-3">Sajt napravljen za Web Programiranje PHP 2</li>
                                                <li class="mt-3"><a target="_blank" href="{{asset('assets/doc/dokumentacija.pdf')}}" class="text-decoration-none" >Dokumentacija</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
