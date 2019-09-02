<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BookComment;
use Illuminate\Support\Facades\Auth;

class BookCommentController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'content'=>'required',
            'book_id'=>'required'
        ]);
        $bookComment=new BookComment;
        $bookComment->content=$request->input('content');
        $bookComment->book_id=$request->input('book_id');
        $bookComment->user_id=!Auth::guest()?Auth::user()->id:2;
        $bookComment->save();
        return redirect("/book/show/$bookComment->book_id");
    }

    public function update(Request $request){
        $this->validate($request,[
            'content'=>'required',
            'comment_id'=>'required|numeric',
            'book_id'=>'required|numeric'
        ]);
        $id=$request->input("comment_id");
        $BookComment=BookComment::find($id);
        $BookComment->id=$id;
        $BookComment->content=$request->input("content");
        //$comment->user_id=!Auth::guest()?Auth::user()->id:2;
        $BookComment->save();
        return redirect("/book/show/$BookComment->book_id");
    }

    public function destroy($id){
        $BookComment=BookComment::find($id);
        $BookComment->delete();
        return redirect("/book/show/$BookComment->book_id");
    }
}
