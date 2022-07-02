<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ObatRequest extends FormRequest
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
            'nama_obat' =>'required|max:225',
            'sediaan' =>'required|max:225',
            'dosis' =>'required|integer',
            'satuan' =>'required|max:225',
            'stok' =>'required|integer',
            'harga' =>'required|integer'
        ];
    }
}
