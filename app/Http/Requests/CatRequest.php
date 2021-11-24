<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CatRequest extends FormRequest
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

        $newSlug = strlen($this->request->get('slug')) > 0
            ? $this->request->get('slug')
            : Str::slug($this->request->get('name'));

        $this->request->add(['slug' => $newSlug]);

        return [

            'name'       => ['required' , 'string' , 'max:100'  ,  Rule::unique('cats' ,  'name')->ignore($this->id)],
            'slug'       => [ 'nullable' , 'string' , 'max:100' , Rule::unique('cats' ,  'slug')->ignore($this->id)],
            'section_id' => ['required' , 'integer'],
        ];
    }

}
