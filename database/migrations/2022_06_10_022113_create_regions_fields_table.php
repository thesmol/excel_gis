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
        Schema::create('regions_fields', function (Blueprint $table) {
            $table->bigInteger('fields_id');
            $table->bigInteger('region_rves_id');

            $table->foreign('fields_id')->references('f_id')->on('fields')->onDelete('cascade');
            $table->foreign('region_rves_id')->references('rr_id')->on('region_rves')->onDelete('cascade');
            $table->primary(['fields_id','region_rves_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions_fields');
    }
};
