<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Click;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClickController extends Controller
{


    public function index(){

        $phone = Click::where('type' , 'phone')->count();
        $whatsapp = Click::where('type' , 'whatsapp')->count();
        $view = Click::where('type' , 'view')->count();

        return view('welcome' , compact('phone' , 'whatsapp' , 'view'));
    }
    public function create($type)
    {

        $names = ['abayas', 'sales'];

        if (!in_array($type, $names)) {

            abort(404);
        }

        Click::create([

                'ip' => \request()->ip(),
                'type' => $type,

            ]);
//        Click::where('type', $type)
//            ->where('ip', \request()->ip())
//            ->where('type', $type)
//            ->where('created_at', '>', Carbon::now()->subDay())
//            ->firstOrCreate([
//
//                'ip' => \request()->ip(),
//                'type' => $type,
//
//            ]);
    }

    public function info($type){


        $names = [ 'view' , 'whatsapp'   , 'phone'];

        if (!in_array($type ,  $names)) {

            abort(404);
        }

        $clicks = Click::where('type' , $type)->get();


        return view('info' , compact('clicks'));

    }


    public function reset(){

        if (\request('password') == "m3m2020") {

            Click::where('id' , '>' , 0)->delete();
        }

        return back();
    }
}
