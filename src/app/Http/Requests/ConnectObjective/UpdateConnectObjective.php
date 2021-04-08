<?php

namespace App\Http\Requests\ConnectObjective;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConnectObjective extends FormRequest
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
            'name' => "required|unique:connect_objectives,name,{$this->id},id|max:255",
            'type' => "required|in:text,checkbox"
        ];
    }
}
