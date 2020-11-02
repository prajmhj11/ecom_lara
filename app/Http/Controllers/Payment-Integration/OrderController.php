<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;


class OrderController extends Controller
{
    //
    public function checkout(Request $request)
    {
        # code...
        if(isset($request->pid)){
            $product = Product::where('id', $request->pid)->first();
            $order = new Order;
            $order->product_id = $product->id;
            $order->invoice_no = $product->id . time();
            $order->total = $product->amount;
            $order->save();

            $fonepay = [];
            $fonepay['MD']= 'P';
            $fonepay['AMT']= $order->total;
            $fonepay['CRN']= 'NPR';
            $fonepay['DT']= date('m/d/Y');
            $fonepay['R1']= 'test';
            $fonepay['R2']= 'test';
            $fonepay['RU']= route('fonepay.return'); //fully valid verification page link
            $fonepay['PRN'] = $order->invoice_no;
            $fonepay['PID'] = 'NBQM';

            $sharedSecretKey = 'a7e3512f5032480a83137793cb2021dc';

            $data = $fonepay['PID'] .','.
                $fonepay['MD'] .','.
                $fonepay['PRN'] .','.
                $fonepay['AMT'] .','.
                $fonepay['CRN'] .','.
                $fonepay['DT'] .','.
                $fonepay['R1'] .','.
                $fonepay['R2'] .',' .
                $fonepay['RU'];

            $fonepay['DV'] = hash_hmac('sha512', $data, $sharedSecretKey);

            return view('layouts.checkout', compact('product', 'order', 'fonepay'));
        }
    }
}
