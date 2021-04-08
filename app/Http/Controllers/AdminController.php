<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function reports(){
        return view('admin.main.reports', $this->data);
    }
    public function activities(){
        $rows = file(storage_path('logs/activities.log'));
        $data = array();
        foreach($rows as $i=>$row){
            $data[$i]["data"] = json_decode(get_string_between($row, '{','}'));
            $data[$i]["message"] = get_string_between($row, ': ',' {');
        }
        return response()->json($data);
    }
}
