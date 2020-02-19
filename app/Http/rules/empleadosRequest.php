<?php


namespace App\Http\rules;


use Illuminate\Foundation\Http\FormRequest;

class empleadosRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return  [
            'nombre' => 'alpha|required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'telefono' => 'numeric|required',
            'correo' => 'email|required',
            'codigo' => 'required',
            'salario_dolar' => 'numeric|required',
            'salario_pesos' => 'numeric|required'
        ];
    }
}
