<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
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
            'ods' => 'required|array|distinct|exists:ods,id',
            'action' => 'required|integer',
            'news' => 'required|integer',
            'protagonismo' => 'required|integer',
            'phoned' => 'required|in:0,1',
            'feedbacks' => 'required|array|distinct|exists:feedbacks,id',
            'empathy' => 'required|integer',
            'team_work' => 'required|integer',
        ];
    }
}
