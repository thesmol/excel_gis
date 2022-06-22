<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_rves', function (Blueprint $table) {
            $table->bigIncrements('rr_id');
            $table->string('region_name');
            $table->string('region_short_name');
            $table->bigInteger('district_rves_id');
            $table->foreign('district_rves_id')->references('dr_id')->on('district_rves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('region_rves');
    }
};
