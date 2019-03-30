<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('package_id')->unsigned()->nullable();
            $table->foreign('package_id')
                ->references('id')
                ->on('gym_packages')
                ->onDelete('cascade');
        });
    }
}
