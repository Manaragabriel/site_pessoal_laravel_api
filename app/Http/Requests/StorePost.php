<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'integer'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Titulo é obrigatório',
            'subtitle.required' => 'Subtitulo é obrigatório',
            'content.required' => 'Conteúdo é obrigatório'
        ];
    }

    public function response(array $errors) {

        return new JsonResponse([
            'status' => '422',
            'errors' => $errors,
        ], 422);
    }

}
