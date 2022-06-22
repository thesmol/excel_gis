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
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('l_id');

            $table->bigInteger('prev_l_id') -> nullable();
            $table->foreign('prev_l_id')
                ->references('l_id')->on('licenses')
                ->onDelete('cascade');

            $table->string('l_series');
            $table->integer('l_number');
            $table->string('l_type  ');

            $table->bigInteger('company_id');
            $table->foreign('company_id')
                ->references('c_id')->on('companies')
                ->onDelete('cascade');

            $table->bigInteger('license_area_id');
            $table->foreign('license_area_id')
                ->references('la_id')->on('license_areas')
                ->onDelete('cascade');

            $table->bigInteger('license_status_id');
            $table->foreign('license_status_id')
                ->references('ls_id')->on('license_statuses')
                ->onDelete('cascade');

            $table->bigInteger('target_destination_id');
            $table->foreign('target_destination_id')
                ->references('td_id')->on('target_destinations')
                ->onDelete('cascade');

            $table->bigInteger('kind_of_fossil_id');
            $table->foreign('kind_of_fossil_id')
                ->references('kf_id')->on('kind_of_fossils')
                ->onDelete('cascade');

            $table->bigInteger('authorities_id');
            $table->foreign('authorities_id')
                ->references('a_id')->on('authorities')
                ->onDelete('cascade');

            $table->date('date_of_start');
            $table->date('date_of_end');
            $table->date('date_of_annulation')->nullable();
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
        Schema::dropIfExists('licenses');
    }
};
