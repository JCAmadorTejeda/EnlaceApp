<?php

namespace App\Http\Controllers\Request;

use App\User;
use App\RequestStatus;
use App\InstallRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class InstallRequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = InstallRequest::all();
        return $this->showAll($request);
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
            'id_employee' => 'required|integer|min:1',
            'numero_os' => 'required',
            'id_status' => 'integer',
            'img_ruta' => 'required|image',
        ];

        $this->validate($request, $rules);

        User::findOrFail($request->id_employee);
        if ($request->has('id_status')) {
            RequestStatus::findOrFail($request->id_status);
        }
        
        $datos = $request->all();

        $datos['id_status'] = (!empty(trim($request->latitud)) && !empty(trim($request->longitud))) ? '1' : '2'; 

        $datos['img_ruta'] = '1.jpg';

        $requets = InstallRequest::create($datos);

        return $this->showOne($requets, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(InstallRequest $installrequest)
    {
        return $this->showOne($installrequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(InstallRequest $request)
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
    public function update(Request $request, InstallRequest $installrequest)
    {
        $rules = [
            'id_employee' => 'integer',
            'latitud' => 'numeric',
            'longitud' => 'numeric',
            'id_status' => 'integer|min:1',
            'img_ruta' => 'image',
        ];

        $this->validate($request, $rules);

        $installrequest->fill($request->intersect([
            'estado',
            'colonia',
            'ciudad',
            'calle',
            'numero',
            ]));
        var_dump($request);
        if($request->has('id_employee')){
            User::findOrFail($request->id_employee);
            $installrequest->id_employee = $request->id_employee;
        }

        if($request->has('latitud')){
            $installrequest->latitud = $request->latitud;
        }

        if($request->has('longitud')){
            $installrequest->longitud = $request->longitud;
        }

        if($request->has('id_status')){
            RequestStatus::findOrFail($request->id_status);
            $installrequest->id_status = $request->id_status;
        }

        if($request->has('numero_os')){
            $installrequest->numero_os = $request->numero_os;
        }

        if($request->has('img_ruta')){
            $installrequest->img_ruta = $request->img_ruta;
        }

       /* $installrequest->estado = $request->estado;
        $installrequest->ciudad = $request->ciudad;
        $installrequest->colonia = $request->colonia;
        $installrequest->calle = $request->calle;
        $installrequest->numero = $request->numero;*/

        if ($installrequest->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $installrequest->save();

        return $this->showOne($installrequest);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstallRequest $request)
    {
        //
    }
}
