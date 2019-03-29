<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackageIdColumnToGymPackagePurchaseHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_packages_purchase_history', function (Blueprint $table) {
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')
                ->references('id')
                ->on('gym_packages')
                ->onDelete('cascade');
        });
    }
}
