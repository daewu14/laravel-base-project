<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\MidtransRepository\Models\MidtransData;
use app\Services\Midtrans\MidtransService;
use Illuminate\Http\Request;
use Midtrans\Config;
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
        // Config::$serverKey = 'SB-Mid-server-D8dUQ4Rie3hrC2J9ndjXLNet';
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // Config::$isProduction = false;
        // // Set sanitization on (default)
        // Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // Config::$is3ds = true;
        
        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => rand(),
        //         'gross_amount' => 10000,
        //     )
        // );
        
        // return Snap::createTransaction($params)->redirect_url;
        $data           = new MidtransData;
        $data->pengirim    = "bekasi";
        $data->penerima    = "ojan";
        return response()->json((new MidtransService($data))->call());
    }
}
