<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataPendaftaranRequest extends FormRequest
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
        'nrm' =>'required|integer',
        'nama_pasien' =>'required|max:225',
        'doctors_id' =>'required|integer',
        'tgl_pendaftaran' =>'required|date'
        ];
    }
}
