<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'posts';

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

        $condName       = "bail|required|between:4,200|unique:$this->table,name";
        $condDesc       = "bail|max:100000";
        $condThumb      = "bail|required";

        if (!empty($id)) { // edit
            $condName  .= ",$id";
            $condThumb  = "";
        }

        return [
            'name'          => $condName,
            'description'   => $condDesc,
            'thumb'         => $condThumb
        ];  
    }
}
