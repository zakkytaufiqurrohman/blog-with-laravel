<?php

namespace App\Http\Controllers;
use App\Setting;
use App\post;
use App\comment;
use App\Category;
use Illuminate\Http\Request;

class indexController extends Controller
{
    //
    public function setting(){
        return Setting::first();
    }
    public function index(){
        $posts=post::where('status',1);
        $data=$this->setting();
        return view('welcome',compact('data','posts'));
    }
    public function blog(){
        $posts=post::where('status',1)->orderBy('published_at', 'DESC')->paginate(4);
        $data=$this->setting();
        return view('blog',compact('data','posts'));
    }
    public function Category($slug){
        $data=$this->setting();
        $Category=Category::where('slug',$slug)->first();
         $posts=$Category->post()->where('status',1)->orderBy('published_at','DESC')->paginate(4);
        return view('blog',compact('data','posts'));

    }
    public function show($slug){
        $post=post::where('slug',$slug)->first();
        $data=$this->setting();

        $prev=Post::where('id','<',$post->id)->latest('id')->first();
        $next=Post::where('id','>',$post->id)->first();
        return view ('show',compact('data','post','prev','next'));
    }
    public function comment(Request $request ,$slug){
        
        $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|email|min:3',
            'body'=>'required|min:5'

        ]);

        $post=Post::where('slug',$slug)->first();
        $request['post_id']=$post->id;
        $request['status']=0;
        comment::create($request->all());

        return redirect()->back();
    }
    public function blog_Search(Request $request){
         
         $data=$this->setting();
         $posts=Post::search($request->get('q'))->orderBy('published_at','DESC')->paginate(4);
        return view('blog',compact('data','posts'));

    }
}