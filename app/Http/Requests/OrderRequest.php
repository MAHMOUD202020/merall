<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\RemoveNonNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\StripTags;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{


    use SanitizesInputs;

    protected $sanitizers = [

        'name' => [StripTags::class],
//        'email' => [StripTags::class],
        'address' => [StripTags::class],
        'phone' => [StripTags::class],
//        'password' => [StripTags::class],
        'country' => [StripTags::class , RemoveNonNumeric::class],
        'area' => [StripTags::class , RemoveNonNumeric::class],
        'not' => [StripTags::class ],
        'serial' => [StripTags::class ],
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

            'name'        => ['required' , 'string' , 'max:20'],
//            'email'       => ['required' , 'string' , 'max:255'],
            'address'     => ['required' , 'string' , 'max:255'],
            'phone'       => ['required', 'string', 'max:20' , Rule::phone() ->country(['EG', 'SA' , 'YE' , 'QA' , 'BH'  , 'KW' , 'AE' , 'JO'])],
//            'password'    => ['string' , 'max:255'],
            'serial'      => ['nullable' , 'string' , 'max:255'],
            'not'         => ['nullable'  , 'string'],
            'country'     => ['required' , 'integer'],
            'area'        => ['required' , 'integer'],
            'payment'     => ['required' , 'string' , 'in:cache,bank'],
            'img_payment' => [Rule::requiredIf($this->request->get('payment') == 'bank'),'image','mimes:jpg,png,jpeg,'],
        ];
    }


    public function messages()
    {

        return [
            "payment.required" => 'من فضلك حدد طريقة الدفع كاش او عن طريق الحولات البنكية',
            'img_payment.required' => 'صورة ارفاق عملية التحويل مطلوبة',
            'img_payment.mimes' => 'صيغة صورة عملية الدفع ليست صحيحة تاكد من ان الصورة تنتعي بصيغة jpg او png او jpeg او gif او svg',
        ];
    }

}
