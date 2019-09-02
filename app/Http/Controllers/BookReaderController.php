<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\BookReader;
use App\Book;
use Auth;
class BookReaderController extends Controller
{
    public function index(){
        $reader_id=!Auth::guest()?Auth::user()->id:2;
        $booksReader=BookReader::where("reader_id",$reader_id)->get();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $reader_posts=Post::where("user_id",$reader_id)->get();
        $comments=Comment::all();
        return view("Reader.book")->with('booksReader',$booksReader)->with('lastEight',$lastEight)
                ->with('reader_posts',$reader_posts)->with('comments',$comments);
    }
    public function show($id){
        $book=BookReader::find($id);
        $books=Book::all();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        $rates=Rate::where('book_id',$id)->get();
        return view("Book.show")->with('book',$book)->with("books",$books)->with('lastEight',$lastEight)->with("rates",$rates);
    }
    public function store(Request $request){
       $this->validate($request,[
            'title'=>'required',
            'author_name'=>'required',
            'description'=>'required',
            'cover'=>'required',
            'book_link'=>'required|mimes:pdf,msword',
            'category_id'=>'required|numeric',
            'isbn'=>'required|numeric',
        ]);
        $bookReader=new BookReader;
        $bookReader->author_name=$request->input("author_name");
        $bookReader->title=$request->input("title");
        $bookReader->description=$request->input("description");
         $cover= $request->file("cover");
         $coverName=$cover->getClientOriginalName();
        $bookReader->cover=time().$coverName;
         $uploaded_book=$request->file('book_link');
         $uploaded_book_name=$uploaded_book->getClientOriginalName();
        $bookReader->book_link=time().$uploaded_book_name;
        $bookReader->category_id=$request->input("category_id");

        $bookReader->reader_id=!Auth::guest()?Auth::user()->id:2;
        $cover->move(public_path('/upload_images/'),$bookReader->cover);
        $uploaded_book->move(public_path('/upload_books/'),$bookReader->book_link);
        $bookReader->isbn=$request->input('isbn');
        $bookReader->status=0;
        $bookReader->save();
        return redirect('/reader');
        //echo $bookReader->isbn;
    }
    public function destroy($id)
    {
        $bookReader=BookReader::find($id);
        $bookReader->delete();
        return redirect('/book');
    }
    public function downloadBook($id){
        $bookReader=BookReader::find($id);
        $path=public_path("/upload_books/$bookReader->book_link");
        return response()->download($path);
    }
    public function reviewBook($id){
        $bookReader=BookReader::find($id);
        $path=public_path("/upload_books/$bookReader->book_link");
        return response()->file($path);
    }
}
