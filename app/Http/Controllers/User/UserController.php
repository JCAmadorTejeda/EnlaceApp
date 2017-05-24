<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();

        return response()->json(['data' => $usuarios], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id_employee' => 'required|unique:users',
            'password' => 'required',
        ];

        $this->validate($request, $rules);

        $campos = $request->all();

        $campos['password'] = bcrypt($request->password);
        $campos['admin'] = User::USUARIO_NO_ADMINISTRADOR;
        $campos['api_key'] = User::generarToken();
        $usuario = User::create($campos);
        return response()->json(['data' => $usuario, 201]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return response()->json(['data' => $usuario], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'password' => 'required',
            'admin' => 'in:' . User::USUARIO_ADMINISTRADOR . ',' . User::USUARIO_NO_ADMINISTRADOR,
            'id_status' => 'in:' . User::EMPLEADO_ACTIVO . ',' . User::EMPLEADO_INACTIVO,
        ];

        $this->validate($request, $rules);
        if($request->has('id_employee')){
            $user->id_employee = $request->id_employee;
        }

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }

        if($request->has('admin')){
            $user->admin = $request->admin;
        }

        if($request->has('id_status')){
            $user->id_status = $request->id_status;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
