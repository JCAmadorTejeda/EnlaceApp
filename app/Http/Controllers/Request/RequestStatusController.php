<?php

namespace App\Http\Controllers\Request;

use App\RequestStatus;
use Illuminate\Http\Request;
use App\Traits\errorResponse;
use App\Http\Controllers\ApiController;

class RequestStatusController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = RequestStatus::all();

        return $this->showAll($status);
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
            'nombre' => 'required',
        ];

        $this->validate($request, $rules);

        $campos = $request->all();

        $campos['nombre'] = $request->nombre;
        $status = RequestStatus::create($campos);
        return $this->showOne($status, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = RequestStatus::findOrFail($id);

        return $this->showOne($status);
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
        $status = RequestStatus::findOrFail($id);

        $rules = [
            'nombre' => 'min:3',
        ];

        $this->validate($request, $rules);


        if($request->has('nombre')){
            $status->nombre = $request->nombre;
        }
        
        if (!$status->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $status->save();

        return $this->showOne($status, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       /* $status = RequestStatus::findOrFail($id);
        $status->delete();
        return response()->json(['data' => $status], 200);*/
    }
}
