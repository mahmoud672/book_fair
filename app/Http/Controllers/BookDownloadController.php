<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BookDownload;
use Illuminate\Support\Facades\Auth;

class BookDownloadController extends Controller
{
    public function store(Request $request,$id){
        $button=$request->input('button');
        $book_id=$id;
        $reader_id=!Auth::guest()?Auth::user()->id:2;
        if($button=='download'){
            $bookDownload=BookDownload::where("book_id",$book_id)->where("reader_id",$reader_id)->first();
            $downloading_times=1;
            //var_dump($bookReview);
            if(count($bookDownload) >0){
                $downloading_times=$bookDownload->downloading_times;
                $bookDownload->book_id=$book_id;
                $bookDownload->reader_id=$reader_id;
                $bookDownload->downloading_times=$downloading_times+1;
                //echo $bookReview->reading_times;
                $bookDownload->save();
                return redirect("/book/$book_id/download");
            }elseif(count($bookDownload) <1){
                $bookDownload= new BookDownload;
                $bookDownload->book_id=$book_id;
                $bookDownload->reader_id=$reader_id;
                $bookDownload->downloading_times=$downloading_times;
                $bookDownload->save();
                //echo 'bbbbbbb';
                return redirect("/book/$book_id/download");
            }
        }
    }
}
