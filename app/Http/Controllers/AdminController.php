<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function reports(){
        return view('admin.main.reports', $this->data);
    }
    public function activities($type ,$page, Request $request){
        if($type == "activities"){
            $rows = file(storage_path('logs/activities.log'));
        }
        else{
            $rows = file(storage_path('logs/errors.log'));

        }
        $rows =  array_reverse($rows);
        $filteredRows = array();

        if($request->date != null){
            $i = 0;
            foreach($rows as $row){
                $dateFromLog = explode(" ", json_decode(get_string_between($row, '{','}'))->time)[0];
                if($request->date == $dateFromLog){
                    $filteredRows[$i++] = $row;
                }
            }
        }
        else{
            $filteredRows = $rows;
        }

        $data = array();
        $i = 0;
        $perPage = 5;
        $offset = 5;
        $start = ($page - 1) * $perPage;

        $data['totalNumber']  = count($filteredRows);

        $n = $start + $offset > count($filteredRows) ? count($filteredRows) : $start + $offset;


        for($j = $start;$j < $n; $j++){
            $data['information'][$i]["data"] = json_decode(get_string_between($filteredRows[$j], '{','}'));
            $data['information'][$i]["message"] = get_string_between($filteredRows[$j], ': ',' {');
            $i++;
        }



        return response()->json($data);
    }

    //        foreach($rows as $i=>$row){
//            $data[$i]["data"] = json_decode(get_string_between($row, '{','}'));
//            $data[$i]["message"] = get_string_between($row, ': ',' {');
//        }
}
