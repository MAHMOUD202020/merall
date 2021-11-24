<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\User;
use App\myDataTable\methodAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{

    use methodAction;

    protected $path = ['0' => 'admin.pages.user' , '1' => 'admin.pages.admin'];
    protected $role = ['0' => 'admin' , '1' => 'user'];

    public function __construct()
    {
        $pram = Route::currentRouteName() === "admin.user.index" ? 0 : 1;

        $this->middleware("haveRole:".$this->role[$pram].".index")->only('index');
        $this->middleware("haveRole:".$this->role[$pram].".create")->only(['create' , 'store']);
        $this->middleware("haveRole:".$this->role[$pram].".update")->only('update');
        $this->middleware("haveRole:".$this->role[$pram].".destroy")->only('destroy');
        $this->middleware("haveRole:".$this->role[$pram].".trash")->only('trash');
        $this->middleware("haveRole:".$this->role[$pram].".restore")->only('restore');
        $this->middleware("haveRole:".$this->role[$pram].".finalDelete")->only('finalDelete');
    }


    public function index()
    {
        $pram = Route::currentRouteName() === "admin.user.index" ? 0 : 1;

        return myDataTable_query(
            User::class ,
            $this->path[$pram].'.index' ,
        false ,
        [
            'typeWhere' =>  ['where' , 'admin' , '=' , $pram],
        ]);
    }


    public function create()
    {

        $pram = Route::currentRouteName() === "admin.user.index" ? 0 : 1;

        $countries  = Country::with('areas')->get(['name' , 'id']);

        return  view($this->path[$pram].'.create')->with('countries' , $countries);
    }


    public function store(UserRequest $request)
    {
        $pram = Route::currentRouteName() === "admin.user.store" ? 0 : 1;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'admin' => $pram,
            'country_id' => $request->country,
            'area_id' => $request->area,
            'password' => bcrypt($request->password),
        ]);



        return  back()->with('success' , 'تم اضافة المستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = User::withTrashed()->findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            $request->has('password') ? 'password' : '' => encrypt($request->password),
        ]);

        return response(['status' => 'success' , 'message' => 'تم تعديل المستخدم بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(User::class , $id);
    }

    public function trash()
    {
        $pram = Route::currentRouteName() === "admin.user.trash" ? 0 : 1;

        return myDataTable_query(
            User::class ,
            $this->path[$pram].'.trash' ,
            true ,
            [
                'typeWhere' =>  ['where' , 'admin' , '=' , $pram]
            ]);

    }

    public function restore($id)
    {

        return $this->MDT_restore(User::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(User::class , $id);
    }
}
