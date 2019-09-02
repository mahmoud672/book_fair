<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Book;
use App\Message;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $id=!Auth::guest()?Auth::user()->id:2;
        $messages=Message::where("sender_id",$id)->orWhere("receiver_id",$id)->get();
        $users=User::all();
        return view("Message.index")->with("lastEight",$lastEight)->with("messages",$messages)->with("users",$users);
    }

    public function store(Request $request){
        $this->validate($request,[
            'receiver_email'=>'required|email',
            'title'=>'required',
            'content'=>'required',
        ]);
        $reciever_email=$request->input("receiver_email");
        $receiver=User::where('email',$reciever_email)->first();
        //$receiver_id=$receiver->id;
        $sender_id=!Auth::guest()?Auth::user()->id:2;
        $message=new Message;
        $message->sender_id=$sender_id;
        $message->receiver_id=$receiver->id;
        $message->title=$request->input("title");
        $message->content=$request->input("content");
        $message->save();
        return redirect('/message')->with("message","message has been sent successfully.");
    }
}
