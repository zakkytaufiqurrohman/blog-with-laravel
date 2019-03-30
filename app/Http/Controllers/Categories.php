<?php

namespace App\Http\Controllers;
use App\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
           'title'=> 'required|unique:categories|min:3'
        ]);
        $request['slug']=str_slug($request->get('title'),'-');
        Category::create($request->all());
        return redirect()->route('admin.categories.index');
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
        $data=Category::FindOrFail($id);
        return view('admin.categories.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::FindOrFail($id);
        return view('admin.categories.edit',compact('data'));
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

        $this->validate($request,[

            'title'=>'required|string|min:3|unique:categories,title,'.$id
        ]);
        $request['slug']=str_slug($request->get('title'),'-');
        $data=Category::FindOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(! Category::destroy($id)) return redirect()->back();
        return redirect()->route('admin.categories.index');
    }
    public function datatable(){
        $category=Category::query();
        return datatables::of($category)
        ->addColumn('action', function($category) {
            return view('layouts.admin.partials._action',[
                'model'=>$category,
                'show_url'=>route('admin.categories.show',$category->id),
                'edit_url'=>route('admin.categories.edit',$category->id),
                'delete_url'=>route('admin.categories.destroy',$category->id),
            ]);
         })
         ->rawColumns(['action'])
        ->make(true);

    }
    
}
