<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
class UsersController extends Controller
{

    public function __construct(){


        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.users.index');
       //return 'ok';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('Admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required',
        ]);
        $request['password']=bcrypt($request->get('password'));
        $request['avatar']=$request->get('avatar') ? $request->get('avatar') : '/photos/user-icon.png';
        User::create($request->all());
        //return $request->all();
        return redirect()->route('admin.users.index');
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
        $user=User::findOrFail($id);

        return view('admin.users.show',compact('user'));
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
        $user=User::findOrFail($id);

        return view('admin.users.edit',compact('user'));
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
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
            'role' => 'required',
        ]);
       
        $user=User::findOrFail($id);
        $request['password']=$request->get('password') ? bcrypt($request->get('password')) : $user->password;
        $user->update($request->all());
        return redirect()->route('admin.users.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! User::destroy($id)) return redirect()->back();
        return redirect()->route('admin.users.index');
    }
    //yajradatatable
    public function datatable(){
        $users=User::query();
        return Datatables::of($users)
        ->addColumn('user', function($users) {
            return '<img src="'. asset('images/user-icon.png') .'" height="32" width="32">'.
            $users->name;
        })
        ->addColumn('action', function($users) {
           return view('layouts.admin.partials._action',[
               'model'=>$users,
               'show_url'=>route('admin.users.show',$users->id),
               'edit_url'=>route('admin.users.edit',$users->id),
               'delete_url'=>route('admin.users.destroy',$users->id),
           ]);
        })
        ->rawColumns(['user','action'])
        ->make(true);
    } 
    //endyajra
    
   
}
