<?php

namespace App\Http\Controllers;
use App\Post;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function __construct(){
        
        $this->middleware('role:author,admin',['only'=>['index','create','show','store','edit','destroy','updaate']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Httpt\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required|String|min:3',
            'body'=>'required|string|min:20',
            'status'=>'required',
            'category_id'=>'required'


        ]);
        $request['slug']=str_slug($request->get('title'),'-');
        $request['user_id']=$request->user()->id;

        post::create($request->all());

        return view('admin.post.index');
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
        $data=post::FindOrFail($id);
        return view('admin.post.show',compact('data'));
        //return $data;
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
        $data=post::FindOrFail($id);
        if(Auth::user()->role=='admin' || Auth::user()->id== $data->user_id){
            return view('admin.post.edit',compact('data'));
        }
        return abort(401);
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
        $data=post::FindOrFail($id);
        if(Auth::user()->role=='admin' || Auth::user()->id==$data->user_id){
            $this->validate($request,[

                'title'=>'required|string|min:3|unique:posts,title,'.$id,
                'body'=>'required|string|min:20',
                'status'=>'required',
                'category_id'=>'required',
            ]);
    
            $request['slug']=str_slug($request->get('title'),'-');
          
            $data->update($request->all());
            //return redirect()->route('admin.post.index');
            return redirect()->route('admin.post.index');
        }
        return abort(401);
        
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Post::FindOrFail($id);
        if(Auth::user()->role=='admin' || Auth::user()->id==$data->user_id){
            if(!post::destroy($id))  return redirect()->back();
            return view ('admin.post.index');
        }
        return abort(401);
        
    }
    public function datatable(){
        $post=Post::query();
        return datatables::of($post)
        ->addColumn('author',function($post){
            return $post->user->name;
        })
        ->addColumn('category',function($post){
            return $post->category->title;
        })
        ->addColumn('action', function($post) {
            return view('layouts.admin.partials._action',[
                'model'=>$post,
                'show_url'=>route('admin.post.show',$post->id),
                'edit_url'=>route('admin.post.edit',$post->id),
                'delete_url'=>route('admin.post.destroy',$post->id),
            ]);
         })
         ->rawColumns(['action','author','category'])
        ->make(true);

    }
}
