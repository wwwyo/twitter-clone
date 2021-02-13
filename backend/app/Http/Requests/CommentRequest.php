<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'text.required' => 'コメントを入力してください',
            'text.max' => 'コメントは300文字いないで入力してください',
        ];
    }
}
