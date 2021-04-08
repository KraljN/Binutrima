@extends('layouts.admin_layout')

@section('title')
    Binutrima | Admin Izveštaji
@endsection

@section('keywords')
    Binutrima | Admin Izveštaji
@endsection

@section('description')
    Binutrima | Admin Izveštaji
@endsection

@section('admin_content')
    <div class="mt-4 mt-md-0" id="aktivnosti">
        <h2 class="tamna">Aktivnosti korisnika</h2>
        <div class="row w-100 mx-0 mt-3 d-flex align-items-center justify-content-center flex-column flex-md-row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <p class="siva mb-0">Izaberite izveštaje po datumu</p>
            </div>
            <div class="col-8 col-md-6 col-lg-4 mt-1 mt-md-0">
                <input class="form-control" type="date" name="" id=""/>
            </div>
            <div class="col-2 mx-auto mt-2 mt-lg-0">
                <button class="btn btn-success" id="allReports">
                    Svi
                </button>
            </div>
        </div>
        <div class="row w-100 mx-0">
            <div class="table-responsive" id="tabelaActivities">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Aktivnost</th>
                            <th>IP adresa</th>
                            <th>Datum i vreme</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nikola Kralj je poslao poruku administratorima: <br/> "Bože pomozi ko ovan ovci"</td>
                            <td>127.0.0.1</td>
                            <td>2021-03-15 12:00:35</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
