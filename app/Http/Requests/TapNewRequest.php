<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TapNewRequest extends FormRequest
{

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

            'value' => [ 'required' , 'string' , 'max:75'],
            'link'  => [ 'nullable' , 'string' , 'max:255'],
            'type'  => ['required' , 'integer'],
        ];
    }

}
