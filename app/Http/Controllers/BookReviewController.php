<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BookReview;
use App\BookDownload;
use Illuminate\Support\Facades\Auth;

class BookReviewController extends Controller
{
   /* public function store($id){
       $book_id=$id;
       $reader_id=!Auth::guest()?Auth::user()->id:2;
       $bookReview=BookReview::where("book_id",$book_id)->where("reader_id",$reader_id)->first();
       $reading_times=1;
       //var_dump($bookReview);
      if(count($bookReview) >0){
           $reading_times=$bookReview->reading_times;
           $bookReview->book_id=$book_id;
           $bookReview->reader_id=$reader_id;
           $bookReview->reading_times=$reading_times+1;
           //echo $bookReview->reading_times;
           $bookReview->save();
          //return redirect("/book/$book_id/review");
       }elseif(count($bookReview) <1){
           $bookReview= new BookReview;
           $bookReview->book_id=$book_id;
           $bookReview->reader_id=$reader_id;
           $bookReview->reading_times=$reading_times;
           $bookReview->save();
           //echo 'bbbbbbb';
          //return redirect("/book/$book_id/review");
       }
    }*/
    public function store(Request $request,$id){

        $button=$request->input('button');
        $book_id=$id;
        $reader_id= Auth::user()->id;
        if($button=='review'){
            $bookReview=BookReview::where("book_id", $book_id)->where("reader_id",$reader_id)->first();
            $reading_times=1;
            //var_dump($bookReview);
            if(count($bookReview) >0){
                $reading_times=$bookReview->reading_times;
                $bookReview->book_id=$book_id;
                $bookReview->reader_id=$reader_id;
                $bookReview->reading_times=$reading_times+1;
                //echo $bookReview->reading_times;
                $bookReview->save();
                return redirect("/book/$book_id/review");
            }elseif(count($bookReview) <1){
                $bookReview= new BookReview;
                $bookReview->book_id=$book_id;
                $bookReview->reader_id=$reader_id;
                $bookReview->reading_times=$reading_times;
                $bookReview->save();
                //echo 'bbbbbbb';
                return redirect("/book/$book_id/review");
            }
        }/*elseif($button=='download'){
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
        }*/
    }
}
