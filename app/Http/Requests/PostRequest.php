<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [

        'slug' => [
            Slug::class,
        ]
    ];


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

            'title'        => ['required' , 'string' , 'max:100'],
            'slug'         => ['nullable' , 'string' , 'max:100' , Rule::unique('posts')],
            'subtitle'     => ['nullable' , 'string' , 'max:255'],
            'description'  => ['required' , 'string'],
            'img'          => ['required' ,'mimes:jpeg,png,jpg,svg' , 'max:5000'],
            'tags'         => ['nullable' , 'string' , 'max:255'],
        ];
    }

}
