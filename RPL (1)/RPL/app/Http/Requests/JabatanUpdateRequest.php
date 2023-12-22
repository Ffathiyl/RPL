<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class JabatanUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'id' =>[
                Rule::unique('jabatans')->ignore($this->route('jabatan'))
            ],
            'nama_jabatan' => 'required|string|max:50',
            'divisi_ids' => ['required','array'],
        ];
    }
}
