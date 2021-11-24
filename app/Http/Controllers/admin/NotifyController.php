<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function remove($id){

        \DB::table('notifications')->where('id' , $id)->delete();

        return 'success';
    }
}
