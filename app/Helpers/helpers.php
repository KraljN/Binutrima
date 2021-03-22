<?php
    function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start) - 1;
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini + 1;
        return substr($string,$ini,$len);
    }
