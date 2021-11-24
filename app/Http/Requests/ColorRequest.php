<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ColorRequest extends FormRequest
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
        $newSlug = strlen($this->request->get('slug')) > 0  ? $this->request->get('slug') : Str::slug($this->request->get('name')).'-'.rand(100000, 9000000);

        $newAlt = strlen($this->request->get('alt')) > 0 ? $this->request->get('alt') : $this->request->get('name');

        $this->request->add(['slug' => $newSlug]);

        $this->request->add(['alt' => $newAlt]);

        return [
            'name'       => ['required' , 'string' , 'max:100'],
            'slug'       => ['nullable' , 'string' , 'max:100' , Rule::unique('colors' ,  'slug')->ignore($this->id)],
            'img'        => ['mimes:jpeg,png,jpg,svg' , 'max:1024'],
            'alt'        => [ 'string' , 'max:255' , 'nullable'],
        ];
    }

}
