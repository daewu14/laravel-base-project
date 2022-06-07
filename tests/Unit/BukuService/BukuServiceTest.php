<?php

namespace Tests\Unit\BukuService;

use App\Repositories\BukuRepository\BukuRepository;
use App\Repositories\BukuRepository\Models\BukuData;
use App\Services\Buku\BukuIndexService;
use App\Services\Buku\BukuService;
use Tests\TestCase;

class BukuServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // index success
    public function test_index_buku_success()
    {
        \Mockery::mock("overload:" . BukuRepository::class)->shouldReceive('index')->andReturn('test');
        $data = (new BukuIndexService)->call();
        // echo "\nresult : " . json_encode($data);
        $this->assertTrue($data->status() == 200);
    }

    public function test_index_buku_error()
    {
        \Mockery::mock("overload:" . BukuRepository::class)->shouldReceive('index')->andReturn('test');
        $data = (new BukuIndexService)->call();
        // echo "\nresult : " . json_encode($data);
        $this->assertFalse($data->status() == 404);
    }

    // create success
    public function test_create_buku_success()
    {
        $expect = (object) [
            "id"         => 49,
            "nama"       => "ojan",
            "penulis"    => "fauzan",
            "jumlah"     => rand(1, 99),
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        \Mockery::mock("overload:" . BukuRepository::class)->shouldReceive("create")->andReturn($expect);

        $data           = new BukuData;
        $data->nama     = "fauzan";
        $data->penulis    = "ojan";
        $data->jumlah = rand(1, 99);

        $service = (new BukuService($data))->call();

        // echo "\nresult : " . json_encode($service);

        $this->assertTrue($service->status() == 200);
        $this->assertTrue($service->data() == $expect);
        $this->assertTrue($service->data()->nama == $expect->nama);
    }

    // create error
    public function test_create_buku_error()
    {
        $expect = (object) [
            "id"         => 49,
            "nama"       => "ojan",
            "penulis"    => "fauzan",
            "jumlah"     => "asas",
            "updated_at" => "2022-06-02T10:02:49.000000Z",
            "created_at" => "2022-06-02T10:02:49.000000Z"
        ];

        \Mockery::mock("overload:" . BukuRepository::class)->shouldReceive("create")->andReturn($expect);

        $data           = new BukuData;
        $data->nama     = "fauzan";
        $data->penulis    = "ojan";
        $data->jumlah = "asas";

        $service = (new BukuService($data))->call();

        // echo "\nresult : " . json_encode($service);

        $this->assertTrue($service->status() != 200);
    }
}
