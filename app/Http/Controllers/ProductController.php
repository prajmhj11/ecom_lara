<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
	{
		$product  = Product::all();
		return view('layouts.product-list', compact('product'));
	}
}
