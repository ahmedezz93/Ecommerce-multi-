<?php

namespace App\Services\payments;

use Illuminate\Support\Facades\Http;

class thawani
{


    const TEST_BASE_URL = "https://uatcheckout.thawani.om/api/v1";
    const LIVE_BASE_URL = "https://checkout.thawani.om/api/v1";

    protected $secretKey;
    protected $publishKey;
    protected $baseUrl;


    public function __construct($secretKey, $publishKey, $mode = 'test')
    {

        $this->secretKey = $secretKey;
        $this->publishKey = $publishKey;


        if ($mode = "test") {

            $this->baseUrl = self::TEST_BASE_URL;
        }

        else {

            $this->baseUrl = self::LIVE_BASE_URL;

        }
    }


    public function createCheckoutSession($data){


        Http::baseUrl($this->baseUrl)->withHeaders([

            'thawani_api_key'=>$this->secretKey,
        ])->asJson()->post('checkout/session',[

            'client_reference_id'=>$data['client_reference_id'],
            'mode'=>'test',
            'products'=>[
                'unit_amount'=>200,
                'quantity'=>4,

            ]
        ]);

    }
};
