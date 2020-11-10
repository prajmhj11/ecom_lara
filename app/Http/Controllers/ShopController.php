<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagination = 6;
        $categories = Category::all();

        if(!(request()->page)){
            session()->put('rand_seed', ['rand' => RAND()]);
        }
        $rand = session()->get('rand_seed')['rand'];

        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        }elseif(request()->all_products){
            $products = Product::take(12);
            $categoryName = 'All Products';
        }else{
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }

        if(request()->sort == 'low_high'){
            $products = $products->orderBy('price')->paginate($pagination)->onEachSide(1);
        }elseif(request()->sort == 'high_low'){
            $products = $products->orderByDesc('price')->paginate($pagination)->onEachSide(1);
        }else{
            $products = $products->inRandomOrder($rand)->paginate($pagination)->onEachSide(1);
        }
        return view('layouts.ecom.shop', compact('products', 'categories', 'categoryName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        return view('layouts.ecom.product', compact('product','mightAlsoLike'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3'
        ]);
        $query = $request->input('query');
        // $products = Product::where('name', 'like', "%$query%")->paginate(10);
        $products = Product::search("$query")->paginate(10);
        return view('layouts.ecom.search-results')->with('products', $products);
    }

    public function searchAlgolia()
    {
        return view('layouts.ecom.search-results-algolia');
    }
}
