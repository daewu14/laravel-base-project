<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Services\Borzo\BorzoService;
use App\Services\Borzo\NewOrderBorzoService;
use App\Services\Borzo\PriceBorzoService;
use Illuminate\Http\Request;

class BorzoController extends Controller
{

    public function index()
    {
        return response()->json(['status' => (new BorzoService)->status()]);
    }

    public function store(Request $request)
    {
        $data              = new PriceBorzoData;
        $data->pengirim    = $request->pengirim;
        $data->penerima    = $request->penerima;
        return response()->json((new PriceBorzoService($data))->call());
    }

    public function new_order(Request $request)
    {
        $data           = new OrderBorzoData;
        $data->isi = $request->isi;
        $data->berat = $request->berat;
        $data->no_pengirim = $request->no_pengirim;
        $data->no_penerima = $request->no_penerima;
        $data->alamat_pengirim = $request->alamat_pengirim;
        $data->alamat_penerima = $request->alamat_penerima;
        $data->nama_pengirim = $request->nama_pengirim;
        $data->nama_penerima = $request->nama_penerima;
        return response()->json((new NewOrderBorzoService($data))->call());
    }
}
