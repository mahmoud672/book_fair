<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Book;
use App\Post;
use Auth;

class ReaderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }
    public function index(){
        $posts=Post::all();
        $comments=Comment::all();
        $books=Book::all();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        return view("Reader.index")->with('books',$books)->with("lastEight",$lastEight)->with('posts',$posts)->with("comments",$comments);
    }

    public function profile(){
        $reader_id=!Auth::guest()?Auth::user()->id:2;
        $books=Book::where("publisher_id",$reader_id)->get();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $reader_posts=Post::where("user_id",$reader_id)->get();
        $comments=Comment::all();
        $personal_info=User::find($reader_id);
        return view("Reader.profile")->with('books',$books)->with('lastEight',$lastEight)
            ->with('reader_posts',$reader_posts)->with('comments',$comments)->with('personal_info',$personal_info);

    }

    public function update_profile(Request $request){
        $this->validate($request,[
            'name'=>'required|alpha',
            'phone'=>'required|numeric|digits:11',
            'show_hide_phone'=>'required|boolean'
        ]);
        $reader_id=!Auth::guest()?Auth::user()->id:2;
        $reader=User::find($reader_id);
        $old_password=$reader->password;
        //$password=$request->input('password')?"":$reader->password;
        //$retype_password=$request->input('retype_password');
        $reader->id=$reader_id;
        $reader->name=$request->input('name');
        $reader->phone=$request->input('phone');
        $reader->phone_status=$request->input('show_hide_phone');
        if($request->input('password')==""){
            $reader->password=$old_password;
            $reader->save();
            return redirect('/reader/profile');
        }elseif(strlen($request->input('password'))<8){
            $messageProfile="password length must be at least 8.";
        }elseif($request->input('retype_password')!=$request->input('password')){
            $messageProfile="retype-password and your new password are not matching.";
        }else{
            $reader->password=$request->input('password');
            $reader->save();
            return redirect('/reader/profile');
        }
        return redirect('/reader/profile')->with("messageProfile",$messageProfile);
    }

    public function userProfile($id){
        $user=User::find($id);
        $user_id=$id;
        $books=Book::where("publisher_id",$user_id)->get();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $user_posts=Post::where("user_id",$user_id)->get();
        $comments=Comment::all();

        return view("Reader.show")->with('books',$books)->with('lastEight',$lastEight)
            ->with('user_posts',$user_posts)->with('comments',$comments)->with('personal_info',$user);
    }
}
