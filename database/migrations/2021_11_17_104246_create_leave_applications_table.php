<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->foreignId('academic_year_id')->constrained();
            $table->foreignId('leave_type_id')->constrained();

            $table->date('start_leave_date');
            $table->date('end_leave_date');
            $table->text('leave_reason')->nullable();
            $table->string('leave_attachment');
            $table->date('leave_approved_return_date')->nullable();
            $table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('leave_applications');
    }
}
