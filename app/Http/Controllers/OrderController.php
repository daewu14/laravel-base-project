<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Midtrans\CreateSnapService;
use Illuminate\Http\Request;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return view('order.index', compact('data'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (empty($order->snap_token)) {
            # jika snap token kosong maka
            $midtrans = new CreateSnapService($order);
            $snapToken = $midtrans->getSnapToken();
            dd($snapToken);
        }
        // $snapToken = $order->snap_token;
        // if (empty($snapToken)) {
        //     // Jika snap token masih NULL, buat token snap dan simpan ke database
 
        //     $midtrans = new CreateSnapService($order);
        //     $snapToken = $midtrans->getSnapToken();
 
        //     $order->snap_token = $snapToken;
        //     $order->save();
        // }
 
        // return view('order.show', compact('order', 'snapToken'));
        // dd($order);
    }
}
