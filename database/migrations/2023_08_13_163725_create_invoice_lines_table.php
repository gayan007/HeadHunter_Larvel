<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLinesTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->integer('no_of_applications');
            $table->decimal('avg_salary', 10, 2);
            $table->decimal('commission_usd', 10, 2);
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_lines');
    }
}
