<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            //doctor
            $table->bigInteger('doctor_id')->unsigned()->index();
            $table->foreign('doctor_id')->references('id')->on('users');
            //specialty
            $table->bigInteger('specialty_id')->unsigned()->index();
            $table->foreign('specialty_id')->references('id')->on('specialties');
            //patient
            $table->bigInteger('patient_id')->unsigned()->index();
            $table->foreign('patient_id')->references('id')->on('users');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('type');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
