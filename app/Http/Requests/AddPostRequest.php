<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPostRequest extends FormRequest
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
        $appendRules = array();
        if(isset($this->image)){
            $appendRules['image'] =  'mimes:jpeg,png,jpg,bmp';
        }
        return [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ] + $appendRules;
    }
}
