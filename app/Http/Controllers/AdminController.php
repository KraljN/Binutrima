<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function index(){
        return view('admin.main.report', $this->data);
    }
}
