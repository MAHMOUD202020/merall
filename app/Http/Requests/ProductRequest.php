<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [

        'slug' => [
            Slug::class,
        ]
    ];


    public function authorize()
    {

        if ($this->request->get('price') < $this->request->get('discount')) {

            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $imgReqOrNul = $this->route()->hasParameter('id') ? "nullable" : "required";

        $newSlug = strlen($this->request->get('slug')) > 0  ? $this->request->get('slug') : Str::slug($this->request->get('name'));

        $newAlt_images = strlen($this->request->get('alt_images')) > 0  ? $this->request->get('alt_images') : $this->request->get('name');

        $newAlt = strlen($this->request->get('alt')) > 0 ? $this->request->get('alt') : $this->request->get('name');

        $this->request->add(['alt' => $newAlt]);

        $this->request->add(['slug' => $newSlug]);

        $this->request->add(['alt_images' => $newAlt_images]);



        return [

            'name'             => ['required' , 'string' , 'max:100' , Rule::unique('products' ,  'name')->ignore($this->id)],
            'slug'             => ['nullable' , 'string' , 'max:100' , Rule::unique('products' ,  'slug')->ignore($this->id)],
            'alt'              => ['nullable' , 'string' , 'max:255'],
            'alt_images'       => ['nullable' , 'string' , 'max:255'],
            'cats'             => ['required'],
            'cats.*'           => ['integer'],
            'price'            => ['required' , 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'discount'         => [ 'nullable' , 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'img'              => [$imgReqOrNul , 'file' , 'mimes:jpeg,png,jpg,svg' , 'max:1024'],
            'images.*'         => ['file' , 'mimes:jpeg,png,jpg,svg'],
            'meta_description' => ['nullable' , 'string' , 'max:255'],
            'seo_title'        => ['nullable' , 'string' , 'max:255'],
            'keyword_tag'      => ['nullable' , 'string' , 'max:255'],

        ];
    }

}
