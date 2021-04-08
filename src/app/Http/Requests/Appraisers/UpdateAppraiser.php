<?php

namespace App\Http\Requests\Appraisers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppraiser extends FormRequest
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
            'status' => "required|in:1,2",
            'email'  => "required|email|unique:users,email,{$this->appraiser->user_id},id"
        ];
    }
}
