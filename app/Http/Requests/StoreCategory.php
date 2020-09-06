<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
            'category' => 'required|max:255',
            'color' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'category.required' => 'Nome da categoria é obrigatório',
            'color.required' => 'Cor para menu é obrigatória',
  
        ];
    }

    public function response(array $errors) {

        return new JsonResponse([
            'status' => '422',
            'errors' => $errors,
        ], 422);
    }

}
