<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Request;
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
        $requests = $user->requests()->where('id_status','=', 3)->get();
        return $this->showAll($requests);
    }
}
