<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->decimal('expected_salary', 10, 2); // Assuming 10 digits including 2 decimal places
            $table->unsignedBigInteger('vacancy_id');
            $table->string('cv_file');
            $table->enum('status', ['applied', 'in-progress', 'rejected', 'selected', 'invoiced'])->default('applied');
            $table->timestamps();
            $table->softDeletes(); // Add soft delete column

            // Foreign key constraint for vacancy_id
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
