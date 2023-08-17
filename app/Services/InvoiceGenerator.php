<?php
// app/Services/InvoiceGenerator.php

namespace App\Services;

use App\Models\Vacancy;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use Carbon\Carbon;
use DB;
use App\Services\CurrencyConverter;

class InvoiceGenerator
{
    public function generatePendingInvoices()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        
        $pendingInvoiceLines = $this->getPendingInvoiceLines($currentMonth);
        $clientId = -1;
        $invoiceTotal = 0;
        $invoice = null;
        $currencyConverter = new CurrencyConverter();

        foreach ($pendingInvoiceLines as $pendingInvoiceLine) {

            if($clientId != $pendingInvoiceLine->clientId) {

                if($invoice) {
                    $invoice->total_amount = $invoiceTotal;
                    $invoice->save();
                    $invoiceTotal = 0;
                }

                // Create an invoice
                $invoice = Invoice::create([
                    'client_id' => $pendingInvoiceLine->clientId,
                    'total_amount' => 0,
                    'due_date' => now()->endOfMonth(),
                    'invoiced_period' => $currentMonth
                ]);
            }

            $invoiceTotal += $pendingInvoiceLine->total_commission;

            $invoiceLine = InvoiceLine::create([
                'invoice_id' => $invoice->id,
                'vacancy_id' => $pendingInvoiceLine->vacanyId,
                'no_of_applications' => $pendingInvoiceLine->noOfApplications,
                'avg_salary' => $pendingInvoiceLine->avg_expected_salary,
                'commission_usd' => $currencyConverter->convertToUSD($pendingInvoiceLine->total_commission, $pendingInvoiceLine->currency_code),
            ]);

            $clientId = $pendingInvoiceLine->clientId;
        }

        if($invoice) {
            $invoice->total_amount = $currencyConverter->convertToUSD($invoiceTotal, $pendingInvoiceLine->currency_code);
            $invoice->save();
        }

        $this->updateApplicationsAsInvoiced();
    }

    public function getPendingInvoiceLines($month) 
    {
        $commission = config('app.head_hunter')['commission'];

        $invoiceData =  DB::table('applications as a')
            ->select('c.id as clientId', 
                    'v.id as vacanyId', 
                    'v.header', 
                    'c.name', 
                    'c.currency_code', 
                    DB::raw('AVG(a.expected_salary) as avg_expected_salary'), 
                    DB::raw('SUM(a.expected_salary) as total_expected_salary'),
                    DB::raw('SUM(a.expected_salary) * '. $commission .' as total_commission'),
                    DB::raw('COUNT(a.id) as noOfApplications'))
            ->join('vacancies as v', 'a.vacancy_id', '=', 'v.id')
            ->join('clients as c', 'v.client_id', '=', 'c.id')
            ->where('a.status', 'selected')
            ->where(DB::raw('DATE_FORMAT(a.updated_at, "%Y-%m")'), '=', $month)
            ->groupBy('v.id', 'v.header', 'c.id', 'c.name', 'c.currency_code')
            ->orderBy('clientId')
            ->get();

        return $invoiceData;

    }

    protected function updateApplicationsAsInvoiced() {
        //TODO: update the status of all applications invoiced to 'invoiced'
    }
}
