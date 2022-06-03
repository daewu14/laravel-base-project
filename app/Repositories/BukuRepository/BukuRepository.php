<?php

namespace App\Repositories\BukuRepository;

use App\Models\Buku;
use App\Repositories\BukuRepository\Models\BukuData;

class BukuRepository implements BukuContract {

    public function create(BukuData $data) {
        return Buku::create([
            "nama"     => $data->nama,
            "penulis"    => $data->penulis,
            "jumlah" => $data->jumlah        
        ]);
    }

    public function index() {
        return Buku::all();
    }
}
