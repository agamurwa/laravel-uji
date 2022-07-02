<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataPasienRequest extends FormRequest
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
        return [
        'id_pasien' =>'required|max:225',
        'nama_pasien' =>'required|max:225',
        'tempat_lahir' =>'required|max:225',
        'tgl_lahir' =>'required|date',
        'alamat' =>'required',
        'jns_kelamin' =>'required|max:225',
        'no_telp' =>'required|numeric'
        ];
    }
}
