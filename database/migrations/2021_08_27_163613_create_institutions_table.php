<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('prefix_code')->nullable();
            $table->text('address');
            $table->foreignId('state_id')->constrained();
            $table->string('phone');
            $table->string('email')->unique();
            $table->foreignId('language_id')->constrained();
            $table->string('website')->nullable();
            $table->foreignId('country_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->string('signature')->nullable();
            $table->integer('use_result_pin')->unsigned()->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('institutions');
    }
}
