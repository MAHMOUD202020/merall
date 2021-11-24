<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Section;
use Illuminate\Http\Request;

class FashionController extends Controller
{
    public function index(){

        $cats = Cat::withCount('products')->where('section_id' , 6)->get();
        $section = Section::find(6);

        return view('web.pages.fashion.index' , compact('cats'  ,'section'));
    }
}
