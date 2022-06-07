<?php

namespace Tests\Unit\Borzo;

use App\Repositories\BorzoRepository\Models\OrderBorzoData;
use App\Repositories\BorzoRepository\OrderBorzoRepository;
use App\Services\Borza\NewOrderBorzaService;
use Tests\TestCase;

class OrderServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_order_service_success()
    {
        $expect = (object) [
            "isi"             => "Buku",
            "berat"           => 3,
            "nama_pengirim"   => "Mas Test",
            "no_pengirim"     => "628000000011",
            "alamat_pengirim" => "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310",
            "nama_pemerima"   => "Mas Unit",
            "no_penerima"     => "628000000011",
            "alamat_penerima" => "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310",
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        // \Mockery::mock("overload:". OrderBorzoRepository::class)->shouldReceive("price")->andReturn($expect);

        $data                   = new OrderBorzoData;
        $data->isi              = "Buku Paket";  
        $data->berat            = 10;
        $data->no_pengirim      = "628100000012";
        $data->no_penerima      = "628100000012";
        $data->alamat_pengirim  = "mutiara bekasi jaya blok b3 no 09 rt 01 rw 07, sindang mulya, kec cibarusah, kab bekasi 17340";
        $data->alamat_penerima  = "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310";
        $data->nama_pengirim    = "Mas Test";
        $data->nama_penerima    = "Mas Unit";
        
        $response = (new NewOrderBorzaService($data))->call();

        // echo "\nresult : ".json_encode($response);

        self::assertTrue($response->status() == 200);
    }

    public function test_order_service_failed()
    {
        $expect = (object) [
            "isi"             => "Buku",
            "berat"           => 3,
            "nama_pengirim"   => "Mas Test",
            "no_pengirim"     => "628000000011",
            "alamat_pengirim" => "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310",
            "nama_pemerima"   => "Mas Unit",
            "no_penerima"     => "628000000011",
            "alamat_penerima" => "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310",
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        // \Mockery::mock("overload:". OrderBorzoRepository::class)->shouldReceive("price")->andReturn($expect);

        $data                   = new OrderBorzoData;
        $data->isi              = "Buku Paket";  
        $data->berat            = 10;
        $data->no_pengirim      = "628100000012";
        $data->no_penerima      = "628100000012";
        $data->alamat_pengirim  = "coba fail";
        $data->alamat_penerima  = "JL. Jawa, Blok J1 No. 31, Komplek Nusaloka, Tangerang, Rw. Mekar Jaya, Serpong, Kota Tangerang Selatan, Banten 15310";
        $data->nama_pengirim    = "Mas Test";
        $data->nama_penerima    = "Mas Unit";
        
        $response = (new NewOrderBorzaService($data))->call();

        // echo "\nresult : ".json_encode($response);

        self::assertFalse($response->status() == 200);
    }
}
