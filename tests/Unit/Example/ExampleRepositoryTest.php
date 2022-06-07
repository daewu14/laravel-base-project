<?php

namespace Tests\Unit\Example;

use App\Repositories\ExampleRepository\ExampleRepository;
use App\Responses\ServiceResponse;
use Tests\TestCase;

class ExampleRepositoryTest extends TestCase {

    // Toggle mock/un-mock
    var bool $mock = true;

    protected function setUp(): void {
        parent::setUp();
        $this->initSetUp();
    }

    public function initSetUp() {
        if ($this->mock) {
            $expect = new ServiceResponse([
                "status" => true,
                "method" => "",
                "rc"     => "01",
                "text"   => "-",
                "banner" => [
                    "id"          => 1,
                    "name"        => "Cukup Satu Pintu Mengelola Pengiriman Paket",
                    "slug"        => "rocket",
                    "image"       => "Slider\/December21\/1639643461_bebas_pilih_expedisi.png",
                    "features"    => "[\"Kirim paket COD \\\/ Bayar ditempat\",\"Pencairan COD dihari yang sama\",\"100% Gratis biaya pendaftaran\"]",
                    "description" => "KiriminAja berkolaborasi dengan berbagai expedisi berkomitmen untuk selalu tepat waktu dalam pengiriman agar lancar dan aman sampai tujuan.",
                    "content"     => "<p>KiriminAja berkolaborasi dengan berbagai expedisi berkomitmen untuk selalu tepat waktu dalam pengiriman agar lancar dan aman sampai tujuan.<\/p>",
                    "user_id"     => 7,
                ],
            ], "loaded", 200);
            \Mockery::mock("overload:" . ExampleRepository::class)->shouldReceive('getInquiry')->andReturn($expect);
        }
    }

    public function testExampleRepositorySuccess() {

        $repo = new ExampleRepository;

        $inquiry = $repo->getInquiry();
        echo "\nresult : " . json_encode($inquiry);

        self::assertTrue($inquiry->status() == 200);
        self::assertTrue($inquiry->message() == "loaded");
    }

}
