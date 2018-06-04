<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscoFormRequestUpdate extends FormRequest
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
            'album' => 'required|min:1|max:100',
            'id_categoria' => 'required',
            'id_artista' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_categoria.required' => 'O campo do categoria é obrigatório.',
            'id_artista.required' => 'O campo do artista é obrigatório.',
            'album.required' => 'O campo do álbum é obrigatório.',
            'required' => 'O campo do :attribute é obrigatório.',
        ];
    }
}
