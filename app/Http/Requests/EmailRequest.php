<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'emails';

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
        $id = $this->id;

        $condEmail = "bail|required|email|unique:$this->table,email";

        if (!empty($id)) { // edit
            $condEmail  .= ",$id";
        }

        return [
            'email'     => $condEmail,
        ];
    }
}
