<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTaskRequest extends FormRequest
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
            'title'       => 'string|nullable',
            'board_id'    => 'nullable|exists:boards,_id',
            'user_id'     => 'string|nullable|exists:users,_id',
            'description' => 'string|nullable',
        ];
    }
}
