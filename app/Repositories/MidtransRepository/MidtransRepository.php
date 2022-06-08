<?php

namespace App\Repositories\MidtransRepository;

use App\Base\HttpService;
use App\Repositories\MidtransRepository\MidtransContract;
use App\Repositories\MidtransRepository\Models\MidtransData;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransRepository implements MidtransContract
{
    // public function __construct()
    // {
    //     Config::$serverKey = 'SB-Mid-server-D8dUQ4Rie3hrC2J9ndjXLNet';
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     Config::$is3ds = true;
    // }

    public function pay(MidtransData $data)
    {
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 145000, // no decimal allowed for creditcard
        );

        // Optional
        $item_details = array(
            'id' => 'a1',
            'price' => 50000,
            'quantity' => 2,
            'name' => "Apple"
        );

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            return Snap::createTransaction($params)->redirect_url;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
