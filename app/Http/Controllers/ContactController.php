<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log;


class ContactController extends BaseController
{
    public function contact(){
        return view('client.main.contact', $this->data);
    }

    public function sendEmail(ContactRequest $request){
        $details = [
            'name'=> $request->nameContact,
            'subject'=>$request->subject,
            'email'=>$request->emailContact,
            'message'=>$request->message
        ];
        $adminsEmails = User::where('role_id', \Config::get('constants.admin_id'))->get('email')->toArray();

        try{
            foreach ($adminsEmails as $emails){
                \Mail::to($emails)->send(new ContactMail($details));
                Log::channel('activity')->info($request->nameContact . " je poslao poruku administratorima", ['ip'=>$request->ip(), 'poruka'=>$request->message, 'time'=>now()]);
            }

            return response()->json(['message'=>'success'], 201);
        }
        catch (\Exception $e){
            Log::channel('errors')->error($e->getMessage(), ['ip'=>$request->ip(), 'path'=>$request->path(), 'method'=>$request->method(), 'time'=>now()]);
            return response()->json(['message'=>'error'], 502);
        }

    }
}
