<?php

namespace App\Http\Controllers;

use App\BookComment;
use App\BookDownload;
use App\Category;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Book;
use App\BookReview;

class BookController extends Controller
{

    public function __construct(){
        $this->middleware("auth");
    }
    public function index()
    {
        $id=!Auth::guest()?Auth::user()->id:2;
        //$books=Book::all();
        $books=Book::where('publisher_id',$id)->get();
        return view("Book.index")->with('books',$books);
    }

    public function create()
    {
        $categories=Category::all();
       return view('Book.add')->with("categories",$categories);
    }

    public function store(Request $request)
    {
       $this->validate($request,
            [
                'title'=>'required',
                'description'=>'required',
                'cover'=>'required',
                'book_link'=>'required|mimes:pdf,msword',
                'category_id'=>'required|numeric',
                'publisher_id'=>'required|numeric ',
            ],
            [
                'category_id.required'=>'category field is required.'
            ]
        );
        $book=new Book;
        $book->title=$request->input("title");
        $book->description=$request->input("description");
         $cover= $request->file("cover");
         $coverName=$cover->getClientOriginalName();
        $book->cover=time().$coverName;
         $uploaded_book=$request->file('book_link');
         $uploaded_book_name=$uploaded_book->getClientOriginalName();
        $book->book_link=time().$uploaded_book_name;
        $book->category_id=$request->input("category_id");

        $book->publisher_id=!Auth::guest()?Auth::user()->id:2;
         $cover->move(public_path('/upload_images/'),$book->cover);
         $uploaded_book->move(public_path('/upload_books/'),$book->book_link);
        $book->status=0;
       /* if(Auth::user()->job_type=='publisher'){
            $book->author_name=NULL;
            $book->isbn=NULL;
        }elseif (Auth::user()->job_type=='reader'){
            $book->author_name=$request->input('author_name');
            $book->isbn=$request->input('isbn');
        }*/

       $book->save();
       return redirect('/book');


    }


    public function show($id)
    {
        $book=Book::find($id);
        $books=Book::all();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $rates=Rate::where('book_id',$id)->get();
        $bookComments=BookComment::where('book_id',$id)->get();
        $booksReview=BookReview::where('book_id',$id)->get();
        $booksDownload=BookDownload::where('book_id',$id)->get();
        $reviews=BookReview::all();
        $downloads=BookDownload::all();
        return view("Book.show")->with('book',$book)->with("books",$books)->
        with('lastEight',$lastEight)->with("rates",$rates)->with('bookComments',$bookComments)
            ->with('booksReview',$booksReview)->with('booksDownload',$booksDownload)
            ->with('reviews',$reviews)->with('downloads',$downloads);
    }


    public function edit($id)
    {
        $book=Book::find($id);
        $categories=Category::all();
        return view("Book.edit")->with('book',$book)->with("categories",$categories);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'description'=>'required',
                'cover'=>'required',
                'book_link'=>'required|mimes:pdf,msword',
                'category_id'=>'required|numeric',
                'publisher_id'=>'required|numeric',
            ],
            [
                'category_id.required'=>'category field is required.'
            ]
        );
        $book=Book::find($id);
        $old_sataus=$book->status;
        $current_status=0;
        $book->id=$request->input('id');
        $book->title=$request->input("title");
        $book->description=$request->input("description");
        $cover= $request->file("cover");
        $coverName=$cover->getClientOriginalName();
        $book->cover=time().$coverName;
        $uploaded_book=$request->file('book_link');
        $uploaded_book_name=$uploaded_book->getClientOriginalName();
        $book->book_link=time().$uploaded_book_name;
        $book->category_id=$request->input("category_id");

        $book->publisher_id=!Auth::guest()?Auth::user()->id:2;
        $cover->move(public_path('/upload_images/'),$book->cover);
        $uploaded_book->move(public_path('/upload_books/'),$book->book_link);
        if($old_sataus==0){
            $current_status=0;
        }elseif ($old_sataus==1){
            $current_status=1;
        }elseif ($old_sataus==2){
            $current_status=2;
        }
        $book->status=$current_status;
        $book->save();
        return redirect('/book');
    }


    public function destroy($id)
    {
       $book=Book::find($id);
       $book->delete();
       return redirect('/book');
    }
    public function downloadBook($id){
        $book=Book::find($id);
        $path=public_path("/upload_books/$book->book_link");
        return response()->download($path);
    }
    public function reviewBook($id){
        //---
        //---
        $book=Book::find($id);
        $path=public_path("/upload_books/$book->book_link");

        return response()->file($path);
    }

}
