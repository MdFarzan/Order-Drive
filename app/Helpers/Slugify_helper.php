<?php

if(!function_exists('slugify')){
    function slugify($str){
        $str = strtolower(trim($str));
        $slug = preg_replace('/[^\w\s-]/','', $str);
        $slug = preg_replace('/[\s_-]+/','-', $slug );
        $slug = preg_replace('/^-+|-+$/','', $slug );
        return $slug;
    }
}