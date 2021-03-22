<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseController
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($userId)
    {
        $user = User::find($userId);
        $currentUser =User::find(Auth::id());
        $this->data['user'] = User::with('userImage', 'userImage.image')->find($userId);
        if(empty($currentUser) || $currentUser->cannot('update', $user)){
            abort(403);
        }
        else{
            return view('client.main.profile', $this->data);
        }
    }

    public function update(UserEditRequest $request, $userId)
    {
        $user = User::find($userId);
        $currentUser =User::find(Auth::id());
        if(empty($currentUser) || $currentUser->cannot('update', $user)){
            abort(403);
        }
        else{
            $image = new Image();//Da be bi $image kod closure funkcije u transakciji bilo undefined kada nema uploadovane slike
            if($request->has('profilePictureFile')){
                        $newName = now()->timestamp . $request->file('profilePictureFile')->getClientOriginalName();
                        Storage::putFileAs('users', $request->file('profilePictureFile'), $newName);
                        if($user->userImage->image->path != 'user.png'){
                            Storage::delete('/users/' . $user->userImage->image->path);
                        }
                        $image->path =  $newName;
                        $image->alt = $newName;
                    }

                        $user->first_name = $request->imeEdit;
                        $user->last_name = $request->prezimeEdit;
                        $user->username = $request->usernameEdit;
                        $user->email = $request->emailEdit;
                        if($request->passOld != 'null'){
                            if(Hash::check($request->passOld, $user->password) && !empty($request->passNew)){
                                $user->password = Hash::make($request->passNew);
                            }
                            else{
                                return response()->json(['message'=>'error'], 401);
                            }
                        }

                        $userImage = $user->userImage;
                        try{
                            DB::transaction(function() use ($user, $userImage, $request, $image){
                                $user->save();
                                if($request->has('profilePictureFile')){
                                    if($user->userImage->image->path != 'user.png'){
                                        $user->userImage->image->delete();
                                    }
                                    $image->save();
                                    $userImage->image()->associate($image);
                                    $userImage->user()->associate($user);
                                    $userImage->save();
                                }
                            });
                            session()->put('userEdit', 'Podaci su uspešno promenjeni');
                            Log::channel('activity')->info(`Korisnik ` . $user->username . ' je izvršio izmenu podataka.', ['ip'=>$request->ip(), 'time'=>now()]);
                            return response()->json(['message'=>'success'], 200);
                        }
                        catch(\Exception $e){
                            Log::channel('errors')->error($e->getMessage(), ['ip'=>$request->ip(), 'path'=>$request->path(), 'method'=>$request->method(), 'time'=>now()]);
                            return response()->json(['message'=>'error'], 400);
                        }

        }
    }

    public function destroy($id)
    {
        //
    }
}

