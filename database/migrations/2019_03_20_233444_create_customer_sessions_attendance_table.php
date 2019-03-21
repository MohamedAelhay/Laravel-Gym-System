<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerSessionsAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sessions_attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('attendance_time');
            $table->date('attendance_date');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('session_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('cascade');
        });
    }
}
