<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createNoteRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required|max:200',
            'image' => 'nullable|max:10000',
            'image.*' => 'nullable|max:10000',
            'note_id' => 'nullable'         
        ];
    }
}
