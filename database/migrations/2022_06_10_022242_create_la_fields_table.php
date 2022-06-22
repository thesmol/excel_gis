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
        Schema::create('la_fields', function (Blueprint $table) {
            $table->bigInteger('license_areas_id');
            $table->foreign('license_areas_id')
                ->references('la_id')->on('license_areas')
                ->onDelete('cascade');

            $table->bigInteger('fields_id');
            $table->foreign('fields_id')
                ->references('f_id')->on('fields')
                ->onDelete('cascade');

            $table->primary(['license_areas_id','fields_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('la_fields');
    }
};
