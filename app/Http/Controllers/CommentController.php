<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class CommentController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $this->validate($request,[
            'content'=>"required",
            'post_id'=>"required",
        ]);
        $comment=new Comment;
        $comment->content=$request->input('content');
        $comment->post_id=$request->input('post_id');
        $comment->user_id=!Auth::guest()?Auth::user()->id:2;
        $comment->save();
        return redirect('/reader');
    }

    public function update(Request $request){
        $this->validate($request,[
            'content'=>'required',
            'comment_id'=>'required|numeric',
            'post_id'=>'required|numeric'
        ]);
        $id=$request->input("comment_id");
        $comment=Comment::find($id);
        $comment->id=$id;
        $comment->content=$request->input("content");
        //$comment->user_id=!Auth::guest()?Auth::user()->id:2;
        $comment->save();
        return redirect("/reader");
    }

    public function destroy($id){
        $comment=Comment::find($id);
        $comment->delete();
        return redirect('/reader');
    }
}
