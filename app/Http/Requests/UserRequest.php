<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{


//    use SanitizesInputs;

//    protected $sanitizers = [
//
//    ];


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

            'name'       => ['required' , 'string' , 'max:20'],
            'email'      => ['required' , 'string' , 'max:255' , Rule::unique('users' , 'email')->ignore($this->id)],
            'phone'      => ['required', 'string', 'max:20' , Rule::phone() ->country(['EG', 'SA' , 'YE' , 'QA' , 'BH'  , 'KW' , 'AE' , 'JO'])],
            'address'    => ['string' , 'max:255'],
            'password'   => [Route::currentRouteName() == "admin.user.update"  || Route::currentRouteName() == "profile.update"  ? '' : 'required' , 'string' , 'min:8' , 'max:255'],
            'country'    => ['integer'],
            'area'       => ['integer'],
        ];
    }

}
