<?php
if (!function_exists('getActiveClass')) {
    function getActiveClass($segment, $matchValue)
    {
        if ($res = array_intersect($matchValue,explode('-', $segment))) {
            if(count($res) > 0)
            {
                return "active";
            }
        }
        return "";
    }
}

if(!function_exists('givePath')){
    function givePath(){
        if(env('APP_ENV') === "production"){
            return base_path();
        } else {
            return public_path();
        }
    }
}