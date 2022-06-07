<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function index()
    {
        $data = Whatsapp::all();
        return view('whatsapp.index', compact('data'));
    }

    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5500/sessions/add', [
            'ids' => $request->number,
            'isLegacy' => 'false',
        ])->json();

        $data = json_encode($response);
        if ($data[0] == 'false') {
            # code...
            return redirect()->route('whatsapp')->with('galat', $data[1]);
        } else {
            # code...
            Whatsapp::create([
                'nama' => $request->name,
                'no_wa' => $request->number
            ]);
            return redirect()->route('whatsapp')->with('success', 'Device Hass Been Added');
        }
        
    }

    public function show($no_wa)
    {
        $data = Whatsapp::where('no_wa', $no_wa)->first();
        if (empty($data)) {
            # code...
            return redirect()->route('whatsapp')->with('galat', 'Device tidak tersedia');
        }

        // return view('whatsapp.view', compact('data'));
        $response = Http::get('http://127.0.0.1:5500/sessions/find/' . $data->no_wa)->json();
        
        echo json_encode($response);
    }
}
