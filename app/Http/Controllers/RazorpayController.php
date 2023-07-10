<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\Payment;

class RazorpayController extends Controller
{
    //
    public $api;
    public function __construct($foo = null)
    {
        $this->api = new Api("rzp_test_ampnuz3NWUHF0M", "Wb4ID5vCdy4yoZGZvgTGknyE");
    }

    public function formPage()
    {

        return view('payment');
    }
    // public function makeOrder(Request $request)
    // {

    //       $phone =$request->input('phone');
    //       $email =$request->input('email');

    //     //   return response()->json([
    //     //      'amount'=>$amount
    //     //   ]);
        
    //     $this->validate($request, [

    //         'amount' => 'required|numeric',
    //     ]);
    //     $orderid = rand(111111, 999999);

    //     $orderData = [
    //         'receipt' => 'receipt_11',
    //         'amount'  => ($request->get('amount') * 100),
    //         'currency' => 'INR',
    //         'notes' => [
    //             'order_id' => $orderid,
    //              'phone' => $phone,
    //         ],
    //     ];

    //     $razorpayOrder = $this->api->order->create($orderData);
    //     return view('order_details', compact('orderid', 'razorpayOrder','phone'));
    // }

    public function makeOrder(Request $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');
     
        
        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);
        
        $orderid = rand(111111, 999999);
        
        $orderData = [
            'receipt' => 'receipt_11',
            'amount'  => ($request->get('amount') * 100),
            'currency' => 'INR',
            'notes' => [
                'order_id' => $orderid,
                'phone' => $phone,
                'email' =>  $email,
            ],
        ];
       
        try {
            $razorpayOrder = $this->api->order->create($orderData);
          
            // Store order information in the order table
            // $status = $this->api->payment->fetch($request->get('payment_id'));

            // if ($status->status == "captured") {
            $order = new Order();
            $order->order_id = $orderid;
            $order->email = $email;
            $order->phone = $phone;
            $order->amount = $request->get('amount');
            $order->payment_id = $razorpayOrder->id;
            $order->save();
            
            // Store payment information in the payment table
            $payment = new Payment();
            $payment->payment_id = 1;
            $payment->status = 'pending'; // Set initial status as pending
            $payment->order_id =2;
            $payment->save();
            
            return view('order_details', compact('orderid', 'razorpayOrder', 'email','phone'));
            // }
        } catch (\Exception $e) {
            // Exception occurred, handle the error
            return response()->json([
                'error' => 'An error occurred while creating the order. Please try again later.'
            ], 500);
        }
    } 
    public function success(Request $request)
    {
        
        $status = $this->api->payment->fetch($request->get('payment_id'));

            // $status = $this->api->payment->fetch($paymentId);
            if ($status->status == "captured") {
                
                    return redirect()->route('payment');
                    // }
                }
        return redirect()->route('payment')->with('failed','Payment failed');
        
    }
    
}
