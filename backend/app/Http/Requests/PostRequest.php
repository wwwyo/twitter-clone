<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'text' => ['required', 'max:300'],
        ];
    }

    public function messages()
    {
        return [
            'text.required' => '投稿を入力してください',
            'text.max' => '投稿は３００文字以内でお願いします',
        ];
    }
}
