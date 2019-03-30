<?php

namespace App\Http\Controllers;
use App\comment;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class Comments extends Controller
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
        return view('admin.comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $comment=Comment::FindOrfail($id);
        return view ('admin.comment.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment=Comment::FindOrfail($id);
        return view ('admin.comment.edit',compact('comment'));
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
            'status'=>'required'

        ]);
        $comment=Comment::FindOrfail($id);
        $comment->Update($request->all());

        return redirect()->route('admin.Comment.index');

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
        if(!Comment::destroy($id)) return redirect()->back();

        return redirect()->route('admin.Comment.index');
    }
    public function datatable(){
        $comment=Comment::query();
        return datatables::of($comment)
            ->addColumn('comment',function($comment){
                return substr($comment->body,0,30);
            })
            ->addcolumn('title',function($comment){
                return substr($comment->post->title,0,30);
            })
            ->addColumn('action',function($comment){
                return view('layouts.admin.partials._action',[
                    'model'=>$comment,
                    'show_url'=>route('admin.Comment.show',$comment->id),
                    'edit_url'=>route('admin.Comment.edit',$comment->id),
                    'delete_url'=>route('admin.Comment.destroy',$comment->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
