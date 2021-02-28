<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategory extends FormRequest
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
        //admin/categories/id
        $id = $this->segment(3);
        return [
            'title' => "required|min:3|max:60|unique:categories,title,{$id},id",
            'url' => "min:3|max:60|unique:categories,url,{$id},id",
            'description' => 'max:2000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Informe um TÍTULO!',
            'url.required' => 'Informe a URL!'
        ];
    }
}
