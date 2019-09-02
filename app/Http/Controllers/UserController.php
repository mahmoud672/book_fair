<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }
    public function index(){
        $users=User::all();
        return view("User.index")->with('users',$users);
    }
    public function show($id){
        $user=User::find($id);
        return view("User.show")->with('user',$user);
    }
    public function destroy($id){
        $user=User::find($id);
        $user->delete();
        return redirect("/user");
    }
}
