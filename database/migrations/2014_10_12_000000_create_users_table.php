<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_employee')->unsigned();
            $table->string('password');
            $table->string('api_key');
            $table->string('admin');
            $table->string('status')->default(User::EMPLEADO_ACTIVO);
            $table->rememberToken();
            $table->timestamps();

            $table->primary('id_employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
