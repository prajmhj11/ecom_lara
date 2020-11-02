<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mightAlsoLike = Product::mightAlsoLike()->get();
        session()->forget('coupon');
        return view('layouts.ecom.cart', compact('mightAlsoLike'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $duplicates = \Cart::search(function($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item is already in the cart!');
        }else{
            \Cart::add($request->id, $request->name, 1, $request->price, 500)
                ->associate('App\Models\Product');
            return back()->with('success_message', 'Item was added to the Cart');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,10',
        ]);

        if($validator->fails()){
            session()->flash('errors', collect(['Quantity must be between 1 and 10!']));
            return response()->json(['success' => false]);
        }
        \Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully.');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        \Cart::remove($id);
        session()->forget('coupon');
        return back()->with('success_message', 'Items has been removed');
    }
    /**
     * Switch item for shopping cart to Save For Later
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
        //
        $item = \Cart::get($id);
        \Cart::remove($id);

        $duplicates = \Cart::instance('saveForLater')->search(function($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if($duplicates->isNotEmpty()){
            return redirect()->route('cart.index')->with('success_message', 'Item is already in Saved For Later');
        }

        \Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, 0)
                ->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success_message', 'Item has been Saved For Later');
    }
}
