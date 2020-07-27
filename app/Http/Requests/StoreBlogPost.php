<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
            'title'=>'required',
            'slug'=>'required',
            'body'=>'required'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Titolo non deve essere vuoto',
            'slug.required' =>  'Sottotitolo non deve essere vuoto',
            'body.required' => 'Testo non deve essere vuoto'
        ];
    }

}
