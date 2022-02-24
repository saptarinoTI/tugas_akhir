<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'tpt_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Silahkan isi :attribute terlebih dahulu.',
            'numeric' => ':Attribute harus berupa angka.',
            'date' => 'Tanggal lahir yang anda input tidak valid.'
        ];
    }
}
