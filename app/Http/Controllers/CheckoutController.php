<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderProduct;
use Exception;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

            $order = $this->addToOrdersTable($request, null);
            Mail::send(new OrderPlaced($order));

            // Successful
            \Cart::instance('default')->destroy();
            session()->forget('coupon');

            return redirect()
                ->route('confirmation.index')
                ->with('success_message', 'Thank you! Your payment has been successfully accepted');
        } catch (CardErrorException $e) {
            $this->addToOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    protected function addToOrdersTable($request, $error){
        // Insert into Orders table
        $order = Order::create([
            'user_id'=> auth()->user() ? auth()->user()->id : null,
            'billing_name' => $request->name,
            'billing_email' => $request->email,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_tax' => $this->getNumbers()->get('newTax'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (\Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
        }

        return $order;
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $code = session()->get('coupon')['name'] ?? null;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = \Cart::subtotal() - $discount;
        $newTax = $newSubtotal*$tax;
        $newTotal = $newSubtotal+$newTax;

        return collect([
            'tax'=> $tax,
            'code'=> $code,
            'discount'=> $discount,
            'newSubtotal'=> $newSubtotal,
            'newTax'=> $newTax,
            'newTotal'=> $newTotal,
        ]);
    }
}
