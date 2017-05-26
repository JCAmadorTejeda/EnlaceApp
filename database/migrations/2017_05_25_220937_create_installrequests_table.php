<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installrequests', function (Blueprint $table) {
            $table->increments('id_request')->unsigned();
            $table->integer('id_employee')->unsigned();
            $table->integer('id_status')->unsigned();
            $table->integer('numero_os')->unsigned();
            $table->string('estado');
            $table->string('ciudad');
            $table->string('colonia');
            $table->string('calle');
            $table->string('numero');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('img_ruta');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_employee')->references('id_employee')->on('users');
            $table->foreign('id_status')->references('id_status')->on('requeststatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installrequests');
    }
}
