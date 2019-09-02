<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class PublisherController extends Controller
{
    public function index(){
        $publisher_id=!Auth::guest()?Auth::user()->id:2;
        $books=Book::where('publisher_id',$publisher_id)->get();
        //$books=Book::all();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        return view("Publisher.index")->with('books',$books)->with("lastEight",$lastEight);
    }

    public function show($id){

    }
}
