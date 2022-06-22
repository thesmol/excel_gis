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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('c_id');
            $table->string('company_name');

            $table->bigInteger('mc_id') -> nullable(); //управляющая компания
            $table->foreign('mc_id')
                ->references('c_id')->on('companies')
                ->onDelete('cascade');

            $table->bigInteger('company_status_id');
            $table->foreign('company_status_id')
                ->references('cs_id')->on('company_statuses')
                ->onDelete('cascade');

            $table->text('address');
            $table->integer('inn');
            $table->integer('code_OKPO');
            $table->integer('code_OKATO');
            $table->integer('OGRN');
            $table->text('comment') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
