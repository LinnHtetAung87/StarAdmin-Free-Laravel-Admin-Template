<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data=Permission::all();
        return view('permission.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("permission.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission=new Permission();
        $permission->name=$request->name;
        $permission->guard_name=$request->guard_name;
        $permission->save();
        $request->session()->flush('message','Successfully Create !');
        $request->session()->flush('alert-class','alert-success');
        //return redirect('permissionlist');
        $data=Permission::all();
        return view('permission.index',compact('data'));
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
        $permission = Permission::find($id);
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //     dd($id);
        $permission = Permission::find($id);
        $permission->name=$request->name;
        $permission->guard_name=$request->guard_name;


       $permission->save();
       $request->session()->flush('message','Successfully Update !');
       $request->session()->flush('alert-class','alert-success');
       $data=Permission::all();
        return view('permission.index',compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //dd($id);
        $permissiondata=Permission::find($id);//get book record by matching with id

        if(isset($permissiondata)){
            //delete
            $permissiondata->Delete();
            $request->session()->flush('Message','Successfully Delete');
            $request->session()->flush('alert-class','alert-success');

        }
        else{
            //display error
            $request->session()->flush('Message','No Record Data');
            $request->session()->flush('alert-class','alert-danger');


        }
        $data=Permission::all();
        return view('permission.index',compact('data'));
    }
}
