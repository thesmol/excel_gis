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
        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('f_id');
            $table->string('field_name');

            $table->bigInteger('field_explorations_id');
            $table->foreign('field_explorations_id')
                ->references('fe_id')->on('field_explorations')
                ->onDelete('cascade');

            $table->text('coords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
