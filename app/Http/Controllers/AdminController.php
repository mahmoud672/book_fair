<?php

namespace App\Http\Controllers;


use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Book;

class AdminController extends Controller
{

    public function index()
    {
        $categoriesCount=Category::all()->count();
        $usersCount=User::all()->count();
        $booksCount=Book::all()->count();
        $lastEight=Book::orderBy('id','DESC')->skip(0)->take(8)->get();
        return view("Admin.index")->with("categoriesCount",$categoriesCount)
            ->with("usersCount",$usersCount)->with("booksCount",$booksCount)->with("lastEight",$lastEight);
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
    public function showBooks(){
        $books=Book::all();
        return view("Admin.book")->with("books",$books);
    }
    public function showReaderBooks(){
        $books=BookReader::all();
        return view("Admin.reader_book")->with("books",$books);
    }
    public function approvedBooks(Request $request){
        $id=$request->input("book_id");
        $status=$request->input("status");
        $book=Book::find($id);
        $book->id=$id;
        $book->status=$status;
        $book->save();
        return redirect('/admin/book');
    }
    public function approvedReaderBooks(Request $request){
        $id=$request->input("book_id");
        $status=$request->input("status");
        $book=BookReader::find($id);
        $book->id=$id;
        $book->status=$status;
        $book->save();
        return redirect('/admin/reader_book');
    }
}
