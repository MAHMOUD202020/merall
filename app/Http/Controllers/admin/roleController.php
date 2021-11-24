<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class roleController extends Controller
{

    const PATH_VIEW = 'admin/pages/roles/';

    public function __construct()
    {
        $this->middleware('haveRole:role.index');

    }
        public function index()
    {
        return myDataTable_query(
            User::class ,
            'admin/pages/roles/index',
            false,
            [
                'typeWhere' => ['where' , 'admin' , '=' ,  1]
            ]
        );
    }



    public function show($id)
    {

        $admin = User::findOrFail($id);
        $roles = Role::all();
        $roleChecked = $admin->roles;

        if ($roleChecked) {

            $roleChecked = $roleChecked->map->name->all();

        }else{

            $roleChecked =[];

        }
        return view('admin/pages/roles/show')->with(['admin' => $admin, 'roles' => $roles, 'roleChecked' => $roleChecked]);
    }


    public function update($id)
    {
        $admin = User::findOrFail($id);
        $admin->roles()->sync(request('name'));

        return back()->with('success' , 'تم تعديل الصلاحيات للمسئول ينجاح المسئول بنجاح');
    }



}


