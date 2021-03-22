<form method="POST" action="{{route('register')}}" enctype="multipart/form-data" class="row g-3 pb-5">
    @method('PUT')
    <div class="col-md-6 d-flex flex-column align-items-md-center">
        <img  class="img-fluid zaobljeno" id="profilePicture" src="{{asset('assets/img/users/' .  $user->userImage->image->path)}}" alt="{{$user->userImage->image->alt}}"/>
        <label class="mt-2" for="profilePictureFile">Trenutna Slika</label>
    </div>
    <div class="col-md-6 d-flex flex-column justify-content-center">
        <input type="file" class="form-control-file" id="profilePictureFile"/>
        <span class="text-danger"></span>
    </div>
    <div class="col-md-6">
        <label for="imeEdit" class="form-label ms-2">Ime</label>
        <input type="text" class="form-control zaobljeno" value="{{$user->first_name}}" id="imeEdit"/>
        <span class="text-danger ms-sm-2"></span>
    </div>
    <div class="col-md-6">
        <label for="prezimeEdit" class="form-label ms-2">Prezime</label>
        <input type="text" class="form-control zaobljeno" value="{{$user->last_name}}" id="prezimeEdit"/>
        <span class="text-danger ms-sm-2"></span>

    </div>
    <div class="col-12">
        <label for="usernameEdit" class="form-label ms-2">Korisničko Ime</label>
        <input type="text" class="form-control zaobljeno" value="{{$user->username}}" id="usernameEdit"/>
        <span class="text-danger ms-sm-2"></span>

    </div>
    @if(Auth::user()->role_id != Config::get('constants.admin_id') || Auth::id() == $user->id)
    <div class="col-md-6">
        <label for="passOld" class="form-label ms-2">Stara Lozinka</label>
        <input type="password" class="form-control zaobljeno" id="passOld"/>
        <span class="text-danger ms-sm-2"></span>

    </div>
    <div class="col-md-6">
        <label for="passNew" class="form-label ms-2">Nova Lozinka</label>
        <input type="password" class="form-control zaobljeno" id="passNew"/>
        <span class="text-danger ms-sm-2"></span>

    </div>
    @endif
    <div class="col-12">
        <label for="emailEdit" class="form-label ms-2">Email</label>
        <input type="email" class="form-control zaobljeno" value="{{$user->email}}" id="emailEdit"/>
        <span class="text-danger ms-sm-2"></span>

    </div>
    <div class="alert alert-danger m-0 info" id="errorUserEdit">
        Došlo je do greške prilikom izmene podataka, molim vas pokušajte kasnije.
    </div>
    @if(session()->has('userEdit'))
    <div class="alert alert-success m-0" id="successUserEdit">
        Podaci uspešno izmenjeni!
    </div>
        {{session()->forget('userEdit')}}
    @endif
    <div class="col-12">
        <button type="submit" id="submitUserEdit"class="btn bg-dark zaobljeno text-white zelelnaPrevlaka">Promeni</button>
    </div>
    <input type="hidden" name="userId" id="userId" value="{{$user->id}}"/>
</form>
