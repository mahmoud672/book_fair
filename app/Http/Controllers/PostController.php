<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){

    }
    public function store(Request $request){
        $this->validate($request,[
            'content'=>'required'
        ]);
        $post=new Post;
        $post->content=$request->input('content');
        $post->user_id=!Auth::guest()?Auth::user()->id:2;
        $post->save();
        return redirect('/reader');
    }
    public function destroy($id){
        $post=Post::find($id);
        $post->delete();
        return redirect('/reader');
    }
    public function update(Request $request){
        $id=$request->input("post_id");
        $post=Post::find($id);
        $post->id=$id;
        $post->content=$request->input('content');
        $manipulatePost=$request->input('manipulatePost');
        //if($manipulatePost=='edit'){
            $post->save();
            return redirect('/reader');
        //}
    }
}
