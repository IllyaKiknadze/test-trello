<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title'       => 'required',
            'board_id'    => 'required|exists:boards,_id',
            'status_id'   => 'required|exists:task_statuses,_id',
            'user_id'     => 'string|nullable|exists:users,_id',
            'description' => 'string|nullable',
//            'labels.*.id' => 'string|nullable|exists:labels,_id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'labels.*.id.exists' => 'The selected label id is invalid.',
        ];
    }
}
