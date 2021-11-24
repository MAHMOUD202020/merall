<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\Slug;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductUpdateAjaxRequest extends FormRequest
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

        $newSlug = strlen($this->request->get('slug')) > 0  ? $this->request->get('slug') : Str::slug($this->request->get('name'));


        $newAlt = strlen($this->request->get('alt')) > 0 ? $this->request->get('alt') : $this->request->get('name');

        $this->request->add(['alt' => $newAlt]);

        $this->request->add(['slug' => $newSlug]);

        return [

            'name'       => ['required' , 'string' , 'max:100' , Rule::unique('products' ,  'name')->ignore($this->id)],
            'slug'       => ['nullable' , 'string' , 'max:100' , Rule::unique('products' ,  'slug')->ignore($this->id)],
            'alt'        => ['nullable' , 'string' , 'max:255'],
            'price'      => ['required' , 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'discount'   => ['required' , 'regex:/^\d{1,13}(\.\d{1,4})?$/'],
            'img'        => ['nullable' , 'file' , 'mimes:jpeg,png,jpg,svg' , 'max:1024'],
            'available'  => ['required' ,  'in:0,1'],
            'premium'    => ['required' ,  'in:0,1'],
        ];
    }

}
