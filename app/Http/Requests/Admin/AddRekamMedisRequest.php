<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddRekamMedisRequest extends FormRequest
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
            'id_pasien' =>'required|exists:patients,nrm',
            'nama_pasien' =>'required|max:225',
            'doctors_id' =>'required|integer|exists:users,id',
            'nama_dokter' =>'required|max:225',
            'keluhan' =>'required',
            'anamnesis' =>'required',
            'pemeriksaan_fisik' =>'required',
            'diagnosa' =>'required|max:225',
            'id_obat' =>'required|integer',
            'jumlah_obat' =>'required|integer',
            'aturan_minum' =>'required|integer',
            'tgl_periksa' =>'required|date',
        ];
    }
}
