<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(is_null($request->coupon_code)){
            return back();
        }
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if(!$coupon){
            return redirect()->route('checkout.index')->withErrors('Invalid coupon code. Please try again.');
        }
        session()->put('coupon',[
            'name' => $coupon->code,
            'total' => \Cart::subtotal(),
            'discount' => $coupon->discount(\Cart::subTotal()),
        ]);
        return redirect()->route('checkout.index')->with('success_message', "Coupon Found and Applied");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return back()->withErrors(collect('Coupon Deleted'));
    }
}
