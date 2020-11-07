<?php

use TCG\Voyager\Facades\Voyager;

function presentPrice($price)
{
    return '$'.number_format($price/100,2);
}

function presentImage($path){
    return $path && (file_exists('storage/'.$path)) ? Voyager::image($path) : asset('img/not-found.jpg');
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

