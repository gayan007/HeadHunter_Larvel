<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Application;
use App\Models\Client;
use App\Services\InvoiceGenerator;
use Carbon\Carbon;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generate invoices for commission';

    public function handle()
    {
        $this->info('Generating invoices for commission...');

        $invoiceGenerator = new InvoiceGenerator();
        $invoiceGenerator->generatePendingInvoices();
        
        $this->info('Invoices generated successfully.');
    }
}
