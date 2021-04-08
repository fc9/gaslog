<?php

namespace App\Http\Requests\SubjectTheme;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectTheme extends FormRequest
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
            'name' => 'required|unique:subject_themes,name,NULL,NULL,deleted_at,NULL|max:255',
            'type' => "required|in:text,checkbox"
        ];
    }
}
