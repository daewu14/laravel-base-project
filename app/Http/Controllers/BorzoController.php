<?php

namespace App\Http\Controllers;

use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Services\Borza\BorzaService;
use App\Services\Borza\NewOrderBorzaService;
use App\Services\Borza\PriceBorzaService;
use App\Services\ExampleService\ExampleService;
use Illuminate\Http\Request;

class BorzoController extends Controller
{
    public function index(Request $request)
    {

        // dd((new BorzaService)->status());
        if ($request->ajax()) {
            # jika ada request ajax check status maka
            return (new BorzaService)->status();
        }

        return view('borzo.index');
    }

    public function store(Request $request)
    {
        $data           = new PriceBorzoData;
        $data->pengirim    = $request->pengirim;
        $data->penerima    = $request->penerima;
        return response()->json((new PriceBorzaService($data))->call());
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
        return response()->json((new NewOrderBorzaService($data))->call());
    }

    public function http_coba()
    {
        $data = new OrderBorzoData;
        $data->isi = "Buku Paket";  
        $data->berat = 10;
        $data->no_pengirim = "628100000012";
        $data->no_penerima = "628100000012";
        $data->alamat_pengirim = "alamat_pengirim";
        $data->alamat_penerima = "alamat_penerima";
        $data->nama_pengirim = "Mas Test";
        $data->nama_penerima = "Mas Unit";
       dd((new NewOrderBorzaService($data))->call());
    }
}
