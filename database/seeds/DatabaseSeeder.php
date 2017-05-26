<?php

use App\User;
use App\RequestStatus;
use App\InstallRequest;
use Illuminate\Database\Seeder;
use Illuminate\Database\statement;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $this->call(UsersTableSeeder::class);
       /* Schema::dropIfExists('employees');
        Schema::dropIfExists('users');
        Schema::dropIfExists('requests');
        Schema::dropIfExists('requeststatus');*/
        User::truncate();
        InstallRequest::truncate();
        RequestStatus::truncate();

        $cantidadEmployyes = 20;
        $cantidadUsers = 20;
        $cantidadRequestStatus = 3;
        $cantidadRequests = 200;

        factory(User::class, $cantidadUsers)->create();
        factory(RequestStatus::class, $cantidadRequestStatus)->create();
        factory(InstallRequest::class, $cantidadRequests)->create();
    }
}
