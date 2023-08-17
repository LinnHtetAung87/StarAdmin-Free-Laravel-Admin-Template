<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        // $sguser= DB::table('users')->where('name','h')->orderBy('name','DESC')->get();
        // //dd($sguser);
        // if($request->session()->has('test')){
        //     $value=$request->session()->forget('test');//for delete session

        // }
        //dd($sguser);

        $data=User::all();


        return view("User.index",compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view("User.create",compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        //$user->role=$request->role;
        $user->assignRole($request->input('roles'));
        $user->save();
        $request->session()->flush('message','Successfully Create !');
        $request->session()->flush('alert-class','alert-success');
        //return redirect()->route('userlist.index');
        $data=User::all();
        return view('User.index',compact('data'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();

        // return view('users.edit',compact('user','roles','userRole'));
        return view('User.edit',compact('user','roles','userRoles'));
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

        $user = User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        //$user->password=$request->password;
        // $input = $request->all();
        // //return $input;
        // if(!empty($request->password)){
        //     $passsword = Hash::make($request->password);
        // }else{
        //     $input = Arr::except($input,array('password'));
        // }
        if ($request->password == $user->password) {
            $password = $request->password;
        }else {
            $password = Hash::make($request->password);
        }
        $user->password=$password;
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->roles);

        $user->save();
        $request->session()->flush('message','Successfully Update !');
        $request->session()->flush('alert-class','alert-success');

        $data=User::all();

        return view("User.index",compact('data'));
        //return redirect('userlist');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $userdata=User::find($id);//get user record by matching with id
        if(isset($userdata)){
            //delete
            $userdata->Delete($id);
            $request->session()->flush('Message','Successfully Delete');
            $request->session()->flush('alert-class','alert-success');

        }
        else{
            //display error
            $request->session()->flush('Message','No Record Data');
            $request->session()->flush('alert-class','alert-danger');
        }
        $data=User::all();
        return view("User.index",compact('data'));

        //return redirect()->route('userlist.index');
        // return redirect('userlist');

    }
       public function searchuser(Request $request){
        $data=array();
        //dd();
        if(isset($request->search1)){
            $data=User::where('name','LIKE','%'.$request->search1.'%')->orwhere('email','LIKE','%'.$request->search1.'%')->orderBy('id','DESC')->get();
        }
        //return $data;
        return view('User.index',compact('data'));
    }
}
