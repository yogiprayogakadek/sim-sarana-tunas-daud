<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SaranaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'nama' => 'required|string',
            'jumlah' => 'required|numeric',
            'kepemilikan' => 'required|string',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'foto' => 'required|mimes:jpeg,jpg,png',
            ];
        } else {
            $rules += [
                'foto' => 'nullable|mimes:jpeg,jpg,png',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'mimes' => ':attribute harus berupa file berformat PDF atau Gambar.',
            'unique' => ':attribute sudah ada',
            'numeric' => ':attribute harus berupa angka',
            'digits' => ':attribute harus berupa angka dan panjangnya :digits digit',
            'in' => ':attribute tidak valid',
            'date' => ':attribute tidak valid'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama sarana',
            'jumlah' => 'Jumlah sarana',
            'kepemilikan' => 'Kepemilikan',
            'foto' => 'Foto',
        ];
    }
}
