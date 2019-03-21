<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('city_manager_id')->unsigned();
            $table->foreign('city_manager_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
