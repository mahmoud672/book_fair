<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Rate;
use Auth;
class RateController extends Controller
{
    public function index(){

    }
    public function store(Request $request){
        $this->validate($request,[
            'evaluation'=>'required|numeric',
            'book_id'=>'required|numeric'
        ]);
        $reader_id=!Auth::guest()?Auth::user()->id:2;
        $book_id=$request->input('book_id');
        $evaluation=$request->input('evaluation');;
        $rate=Rate::where("book_id",$book_id)->where("reader_id",$reader_id)->first();
         if(count($rate) >0){
             $rate->book_id=$book_id;
             $rate->reader_id=$reader_id;
             $rate->evaluation=$evaluation;
             $rate->save();
             //echo $rate->evaluation." ".$rate->book_id." ".$rate->reader_id;
         }else{
             $newRate=new Rate;
             $newRate->book_id=$book_id;
             $newRate->reader_id=$reader_id;
             $newRate->evaluation=$evaluation;
             $newRate->save();
         }

        return redirect("/book/show/$book_id");
    }
}
