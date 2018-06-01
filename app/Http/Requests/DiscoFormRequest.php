<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscoFormRequest extends FormRequest
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
            'artista' => 'required|min:1|max:150',
            'genero' => 'required',
            'capa' => 'required|min:1|max:255',
        ];
    }

    public function messages()
    {
        return [
            'genero.required' => 'O campo do gênero é obrigatório.',
            'album.required' => 'O campo do álbum é obrigatório.',
            'required' => 'O campo do :attribute é obrigatório.',
        ];
    }
}
