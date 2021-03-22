<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class MostPopularController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $rows = file(storage_path('logs/access.log'));
        $jsonRows = array();
        foreach ($rows as $row){
            $jsonRows[] = json_decode(get_string_between($row, '{','}'));
        }
        $popularity = array();
        $this->data['mostPopular'] = array();
        if(isset($jsonRows[0])){
            foreach ($jsonRows as $jsonRow){
                if(!isset($popularity[$jsonRow -> post_id])){
                    $popularity[$jsonRow -> post_id] = 0;
                }
                $popularity[$jsonRow -> post_id]++;
            }
            arsort($popularity);
            $idValues = array_keys($popularity);
            for($i=0; $i<\Config::get('constants.most_popular_number'); $i++){
                if(isset($idValues[$i])){
                    array_push($this->data['mostPopular'], Post::where('id', $idValues[$i])->first());
                }
            }
        }
    }
}
