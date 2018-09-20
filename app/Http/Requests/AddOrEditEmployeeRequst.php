<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrEditEmployeeRequst extends FormRequest
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

    public function rules()
    {
        return [
            'first_name'  => 'required|alpha|max:255',
            'last_name'   => 'required|alpha|max:255',
            'middle_name' => 'nullable|alpha|max:255',
            'gender'      => 'nullable|in:male,female',
            'salary'      => 'nullable|numeric',
            'departments' => 'required|min:1',
        ];
    }
}
