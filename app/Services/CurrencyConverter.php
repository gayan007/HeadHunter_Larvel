<?php
// app/Services/CurrencyConverter.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected $USDcurrencyRates;

    public function __construct()
    {
        $response = Http::get(config('app.head_hunter')['usd_convert_api_link']);
        $USDcurrencyRates = $response->json();
        $this->USDcurrencyRates = $USDcurrencyRates["usd"];
    }    

    public function convertToUSD($amount, $fromCurrency)
    {
        // Convert the amount to USD
        if ((isset($this->USDcurrencyRates[$fromCurrency])) && ($fromCurrency != 'usd')) { 
            
            return $amount / $this->USDcurrencyRates[$fromCurrency];
        }

        return $amount; // Return the same amount if the conversion rate is not available
    }
}
