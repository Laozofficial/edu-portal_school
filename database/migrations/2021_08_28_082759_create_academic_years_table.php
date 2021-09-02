<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained();
            $table->integer('start_year')->unsigned();
            $table->string('start_month');
            $table->integer('end_year')->unsigned();
            $table->string('end_month');
            $table->string('term');
            $table->integer('results_approved')->unsigned()->default(0);
            $table->integer('cumulative')->unsigned()->default(0);
            $table->integer('status')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
}
