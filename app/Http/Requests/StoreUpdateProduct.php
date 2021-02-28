<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
        $id = $this->segment(3);
        return [
            'name' => "required|min:3|max:100|unique:products,name,{$id},id",
            'url' => "min:3|max:100|unique:products,url,{$id},id",
            'price' => 'required',
            'description' => 'max:2000',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo NOME é obrigatório!',
            'url.required' => 'Campo URL é obrigatório!',
            'price.required' => 'Campo PREÇO é obrigatório',
            'category_id.required' => 'CATEGORIA'
        ];
    }
}
