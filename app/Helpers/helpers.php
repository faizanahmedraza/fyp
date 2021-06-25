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