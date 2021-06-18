<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesRequest extends FormRequest
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
            'file'=>'required|max:1000'
        ];
    }

    public function messages(){
        return [
            'file.required'=>'O arquivo é obrigatório',
            'file.max'=>'O peso da imagem deve ser no máximo 1 mb',
        ];
    }

}
