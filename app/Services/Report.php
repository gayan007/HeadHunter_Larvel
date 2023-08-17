<?php
// app/Services/InvoiceGenerator.php

namespace App\Services;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Http;
use App\Services\CurrencyConverter;

class Report
{
    public function getPipelinePendngData()
    {
        $commission = config('app.head_hunter')['commission'];
        $currencyCode = config('app.head_hunter')['default_currency_code'];
        $currencyConverter = new CurrencyConverter();

        $reportData = Vacancy::select('vacancies.id', 'vacancies.header', 'clients.name', 'clients.currency_code')
            ->join('applications', 'vacancies.id', '=', 'applications.vacancy_id')
            ->join('clients', 'vacancies.client_id', '=', 'clients.id')
            ->whereIn('applications.status', ['applied', 'in-progress'])
            ->groupBy('vacancies.id', 'vacancies.header', 'clients.name', 'clients.currency_code')
            ->selectRaw('COUNT(applications.id) as application_count')
            ->selectRaw('FORMAT(AVG(applications.expected_salary), 2) as avg_expected_salary')
            ->selectRaw('SUM(applications.expected_salary) as total_expected_salary')
            ->selectRaw('SUM(applications.expected_salary) * '. $commission .' as total_commission')
            ->get(); 

        foreach ($reportData as $item) {     
            //dd($item);               
            $item->usd_equivalent_total = number_format($currencyConverter->convertToUSD($item->total_expected_salary, $item->currency_code), 2);
            $item->usd_equivalent_total_commission = number_format($currencyConverter->convertToUSD($item->total_commission, $item->currency_code), 2);
        }

        return $reportData;

    }
}