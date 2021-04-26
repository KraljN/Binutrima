<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function reports(){
        return view('admin.main.reports', $this->data);
    }
    public function activities($page){
        $rows = file(storage_path('logs/activities.log'));
        $rows =  array_reverse($rows);

        $data = array();
        $i = 0;
        $perPage = 5;
        $offset = 5;
        $start = ($page - 1) * $perPage;

        $data['totalNumber']  = count($rows);

        $n = $start + $offset > count($rows) ? count($rows) : $start + $offset;


        for($j = $start;$j < $n; $j++){
            $data['information'][$i]["data"] = json_decode(get_string_between($rows[$j], '{','}'));
            $data['information'][$i]["message"] = get_string_between($rows[$j], ': ',' {');
            $i++;
        }


//        foreach($rows as $i=>$row){
//            $data[$i]["data"] = json_decode(get_string_between($row, '{','}'));
//            $data[$i]["message"] = get_string_between($row, ': ',' {');
//        }
        return response()->json($data);
    }
}
