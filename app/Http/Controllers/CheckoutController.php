<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Exception;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        if (\Cart::instance('default')->count() <= 0) {
            return redirect()->route('cart.index');
        }

        return view('layouts.ecom.checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
        ]);
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
    public function store(CheckoutRequest $request)
    {
        $request->validated();

        $contents = \Cart::content()->map(function ($item) {
            return $item->model->slug . ',' . $item->qty;
        })->values()->toJson();

        try {
            //code...
            $charge = \Stripe::charges()->create([
                "amount" => $this->getNumbers()->get('newTotal') / 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "Order",
                "receipt_email" => $request->email,
                "metadata" => [
                    // change to Order ID after we start using DB
                    'contents' => $contents,
                    'quantity' => \Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            // Successful
            \Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()
                ->route('confirmation.index')
                ->with('success_message', 'Thank you! Your payment has been successfully accepted');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = \Cart::subtotal() - $discount;
        $newTax = $newSubtotal*$tax;
        $newTotal = $newSubtotal+$newTax;

        return collect([
            'tax'=> $tax,
            'discount'=> $discount,
            'newSubtotal'=> $newSubtotal,
            'newTax'=> $newTax,
            'newTotal'=> $newTotal,
        ]);
    }
}
