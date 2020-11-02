<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class EsewaController extends Controller
{
    //
    public function success(Request $request)
    {

        if (isset($request->oid) && isset($request->amt) && isset($request->refId)) {
            $order = Order::where('invoice_no', $request->oid)->first();
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data = [
                'amt' => $order->total,
                'rid' => $request->refId,
                'pid' => $order->invoice_no,
                'scd' => 'epay_payment'
            ];
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            dd(response);
            curl_close($curl);

            $xmlString = simplexml_load_string($response) or die('Error: Cannot create object');

            $resp_code = (string)$xmlString->response_code;

            if ($resp_code == 'Success') {
                $order->status = 1;
                $order->save();
                return redirect()
                    ->route('payment.response')
                    ->with('success_message', 'Transaction completed');
            }
        }
    }

    public function fail(Request $request)
    {
        return redirect()
            ->route('payment.response')
            ->with('error_message', 'Transaction cancelled');
    }

    public function payment_response()
	{
		return view('layouts.response-page');
	}
}
