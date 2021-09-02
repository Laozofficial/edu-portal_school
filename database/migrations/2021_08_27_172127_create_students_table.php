<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('image')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->foreignId('country_id')->constrained();
            $table->string('blood_group')->nullable();
            $table->string('religion');
            $table->text('permanent_address');
            $table->text('present_address');
            $table->string('city');
            $table->foreignId('state_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->string('father_name');
            $table->string('father_phone');
            $table->string('mother_name');
            $table->string('mother_phone');
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
        Schema::dropIfExists('students');
    }
}
