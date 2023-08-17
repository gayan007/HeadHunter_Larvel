<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->text('description');
            $table->decimal('salary_min', 10, 2); // Assuming 10 digits including 2 decimal places
            $table->decimal('salary_max', 10, 2);
            $table->unsignedBigInteger('client_id');
            $table->integer('available_positions');
            $table->timestamps();
            $table->softDeletes(); // Add soft delete column

            // Foreign key constraint for client_id
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
