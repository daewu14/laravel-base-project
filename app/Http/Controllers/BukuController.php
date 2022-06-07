<?php

namespace App\Http\Controllers;

use App\Services\Buku\BukuIndexService;
use App\Services\Buku\BukuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [
        //     'receiver' => '6281912488040',
        //     'message' => [
        //         'text' => 'hai'
        //     ]
        // ];
        // $response = Http::contentType("application/json")->send('POST', 'http://127.0.0.1:5500/chats/send?id=ojan', [
        //     json_encode($data)
        // ])->json();

        // // dd($response);
        // echo json_encode($response);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://127.0.0.1:5500/chats/send?id=ojan', [
            'receiver' => '6281912488040',
            'message' => [
                'text' => 'hai'
            ]
        ])->json();

        echo json_encode($response);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
