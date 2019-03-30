<?php

namespace App\Http\Controllers;
use App\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    //
    public function __construct(){

        $this->middleware('role:admin');
    }
    public function index()
    {
        $data=Setting::first();
        return view('admin.setting.index',compact('data'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'tagline'=>'required',
            'phone'=>'required',
            'email'=>'required|email',
            'address'=>'required',


        ]);
        Setting::updateOrCreate(['id'=>1],$request->all());
        
        return redirect()->route('admin.setting.index');
       
    }
}
