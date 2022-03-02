<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validator\Validation;

class UserPostRequest extends FormRequest
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
    public function rules(): array
    {

        $appendRules = array();
        if(isset($this->password)){
            $appendRules['password'] = 'required|min:8';
        }else{
            $appendRules['password'] = 'nullable';
        }
        return [
            'name' => 'required',
            'email' => 'required|email',
        ] + $appendRules;
    }
}
