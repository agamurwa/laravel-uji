<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DataDokterRequest extends FormRequest
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
        'nama_dokter' =>'required|max:225',
        'no_telp' =>'required|numeric',
        'alamat' =>'required',
        'tempat_lahir' =>'required|max:225',
        'tgl_lahir' =>'required|date',
        'bidang' =>'required|max:225',
        'tentang_dokter' =>'required',
        'riwayat_pendidikan' =>'required',
        'riwayat_pekerjaan' =>'required',
        'organisasi' =>'required'
        ];
    }
}
