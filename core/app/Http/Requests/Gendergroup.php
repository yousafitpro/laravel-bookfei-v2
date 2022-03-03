<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Gendergroup extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'adult_age_end'=>'required|gt:adult_age_start',
            'child_age_end'=>'required|gt:child_age_start',
            'toddler_age_end'=>'required|gt:toddler_age_start',
            'infant_age_end'=>'required|gt:infant_age_start',
            'senior_age_end'=>'required|gt:senior_age_start',

            'child_age_end'=>'required|in:'.($request->adult_age_start-1).'',
            'toddler_age_end'=>'required|in:'.($request->child_age_start-1).'',
            'infant_age_end'=>'required|in:'.($request->toddler_age_start-1).'',
            'senior_age_start'=>'required|in:'.($request->adult_age_end+1).'',
        ];
    }
}
