<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengembalianRequest extends FormRequest
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
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ];

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
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
        ];
    }
}
