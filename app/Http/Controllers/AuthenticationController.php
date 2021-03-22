<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserImage;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthenticationController extends BaseController
{
    public function index(){
        return view('client.main.login', $this->data);
    }
    public function register(RegisterRequest $request){
        try{
            DB::transaction(function () use ($request) {
                define('DEFAULT_IMAGE_PATH', 'assets/img/users/user.png');
                define('USER', 1);
                $image = Image::where('path', DEFAULT_IMAGE_PATH)->first();

                $role = Role::find(USER);


                $user = new User();
                $user->first_name = $request->ime;
                $user->last_name = $request->prezime;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->pass);
                $user->role()->associate($role);

                $user->save();

                $userImage = new UserImage();
                $userImage->user()->associate($user);
                $userImage->image()->associate($image);

                $userImage->save();
                Log::channel('activity')->info("Korisnik uspešno napravljen.", ['ip'=>$request->ip(), 'path'=>$request->path(), 'user_id'=>$user->id, 'time'=>now()]);

            });
            return response()->json(["message"=>"success"], 201);
        }
        catch(\Exception $e){
            Log::channel('errors')->error($e->getMessage(), ['ip'=>$request->ip(), 'path'=>$request->path(), 'method'=>$request->method(), 'time'=>now()]);
            return response()->json(["message"=>"error"], 409);
        }
    }
    public function login(LoginRequest $request){
        if(Auth::attempt(['username' => $request->usernameLog, 'password' => $request->passLog])){
            $request->session()->regenerate();
            Log::channel('activity')->info("Korisnik $request->usernameLog se prijavio", ['ip'=>$request->ip(), 'time'=>now()]);
            if(Auth::user()->role_id == Config::get('constants.admin_id')){
                return route('admin');
            }
            else{
                return route('home');
            }
        }
        else{
            return response()->json(["message"=>"error"], 401);
        }
    }
    public function logout(Request $request ){
        Log::channel('activity')->info("Korisnik " . Auth::user()->username . " se odjavio", ['ip'=>$request->ip(), 'time'=>now()]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
