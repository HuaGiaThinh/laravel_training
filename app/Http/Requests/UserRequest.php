<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'users';

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

        $condName       = "bail|required|between:4,100";
        $condEmail      = "bail|required|email|unique:$this->table,email,$id";
        $condPass       = 'bail|required|between:5,100';

        if (!empty($id)) { // edit
            $condEmail  = "";
            $condPass   = "";
        }

        return [
            'name'      => $condName,
            'email'     => $condEmail,
            'password'  => $condPass
        ];
    }
}
