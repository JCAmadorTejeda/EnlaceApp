<?php

namespace App\Http\Controllers\Request;

use App\User;
use App\InstallRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class UserRequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $requests = $user->InstallRequests()->get();
        return $this->showAll($requests);
    }

}
