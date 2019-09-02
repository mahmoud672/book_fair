<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Book;
use App\Comment;
use App\Post;

class SearchController extends Controller
{
    public function index(){
        $posts=Post::all();
        $comments=Comment::all();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        /*$this->validate($request,[
            'search'=>'required'
        ]);*/

        //$searchKey=$request->input('search');
        $searchKey=Input::get('search');;
        if($searchKey !=""){
            $books=Book::where('title',"like","%{$searchKey}%")->get();
            if(count($books) >0){
                return view('Search.index')->with('books',$books)->with("lastEight",$lastEight)->with('posts',$posts)->with("comments",$comments);
            }else{
                return view('Search.index')->with('message','no books found')->with("lastEight",$lastEight)->with('posts',$posts)->with("comments",$comments);
            }
        }
    }
}
