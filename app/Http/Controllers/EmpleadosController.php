<?php

namespace App\Http\Controllers;

use App\Empleados;
use App\Http\rules\empleadosRequest;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Empleados::where('eliminado',0)->get();
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
    public function store(empleadosRequest $request)
    {
        if(isset($request->id)){
            $empleado = Empleados::find($request->id);
            $empleado->codigo = $request->codigo;
            $empleado->nombre = $request->nombre;
            $empleado->salario_dolar = $request->salario_dolar;
            $empleado->salario_pesos = $request->salario_pesos;
            $empleado->direccion = $request->direccion;
            $empleado->direccion = $request->direccion;
            $empleado->ciudad = $request->ciudad;
            $empleado->ciudad = $request->ciudad;
            $empleado->telefono = $request->telefono;
            $empleado->telefono = $request->telefono;
            $empleado->correo = $request->correo;
            $empleado->save();
        }else{
            $empleado = new Empleados();
            $empleado->codigo = $request->codigo;
            $empleado->nombre = $request->nombre;
            $empleado->salario_dolar = $request->salario_dolar;
            $empleado->salario_pesos = $request->salario_pesos;
            $empleado->direccion = $request->direccion;
            $empleado->direccion = $request->direccion;
            $empleado->ciudad = $request->ciudad;
            $empleado->ciudad = $request->ciudad;
            $empleado->telefono = $request->telefono;
            $empleado->telefono = $request->telefono;
            $empleado->correo = $request->correo;
            $empleado->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function activar( Request $request)
    {
        $empleado = Empleados::find($request->id);
        $empleado->activo =  !$request->activo;
        $empleado->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleados::find($id);
        $empleado->eliminado =  true;
        $empleado->save();
    }
}
