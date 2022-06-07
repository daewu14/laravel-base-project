<?php

namespace Tests\Unit\Borzo;

use App\Repositories\BorzoRepository\Models\PriceBorzoData;
use App\Repositories\BorzoRepository\PriceBorzoRepository;
use App\Services\Borza\PriceBorzaService;
use Tests\TestCase;

class PriceServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPriceServiceSuccess()
    {
        // $expect = (object) [
        //     "pengirim"   => "bekasi",
        //     "pemerima"   => "cikarang",
        //     "updated_at" => "2022-06-02T10:02:49.000000Z",
        //     "created_at" => "2022-06-02T10:02:49.000000Z"
        // ];

        // \Mockery::mock("overload:". PriceBorzoRepository::class)->shouldReceive("price")->andReturn($expect);

        $data           = new PriceBorzoData;
        $data->pengirim    = "bekasi";
        $data->penerima    = "banten";
        
        $response = (new PriceBorzaService($data))->call();

        // echo "\nresult : ".json_encode($response);

        self::assertTrue($response->status() == 200);
    }

    public function testPriceServiceFailed()
    {
        // $expect = (object) [
        //     "pengirim"   => "bekasi",
        //     "pemerima"   => "cikarang",
        //     "updated_at" => "2022-06-02T10:02:49.000000Z",
        //     "created_at" => "2022-06-02T10:02:49.000000Z"
        // ];

        // \Mockery::mock("overload:". PriceBorzoRepository::class)->shouldReceive("price")->andReturn($expect);

        $data           = new PriceBorzoData;
        $data->pengirim    = "bekasi";
        $data->penerima    = "banten@gmail.com";
        
        $response = (new PriceBorzaService($data))->call();

        // echo "\nresult : ".json_encode($response);

        self::assertFalse($response->status() != 200);
    }
}
