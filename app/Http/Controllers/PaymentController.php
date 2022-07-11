<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use shopid\zarinPal;

class PaymentController extends Controller
{

    function zarinpalpay(Order $order) {
      
        $payment = Payment::create([
            "order_id"=>$order->id,
            "bank"=>"zarinpal"
        ]);

        $zarinpal = new zarinPal([
            "merchantId" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
        ]);

          
        try {

            $request = $zarinpal->apiRequest([

                "callbackurl" => "http://127.0.0.1:8000/zarinpalVerify/" . $payment->id,
                "amount" => $order->amount*10,
                "description" => "order#".$order->id,
                    "email" => "user@mail.com",
                    "mobile" => "09120000000",

            ]);

            $payment->requestInfo = $request;
            $payment->save();

            $requestDecoded = json_decode($request);
            return redirect()->intended($requestDecoded->url);


        } catch (\Exception $error) {
            var_dump(json_decode($error->getMessage()));
        }



    }


    function zarinpalVerify(Payment $payment) {

        $zarinpal = new zarinPal([
            "merchantId" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
        ]);

        $order = Order::find($payment->order_id);

        $reqinfo = json_decode($payment->requestInfo);


        try {

            $verify = $zarinpal->verify([
                "authority" => $reqinfo->authority,
                "amount" => $order->amount*10
            ]);

            $verifyDecoded = json_decode($verify);

            if ($verifyDecoded->code == 100 || $verifyDecoded->code == 101) {
                $payment->status = 1;
                echo "سفارش " . $payment->order_id . " با موفقیت پرداخت شد";
            }

            $payment->verifyinfo = $verify;


        } catch (\Exception $err) {

            $payment->verifyinfo = $err->getMessage();
            var_dump($err->getMessage());

        }

        $payment->save();


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
