<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Category;
//use Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories=Category::all();
        return view("Category.index")->with("categories",$categories);
    }

    public function create()
    {
        return view('Category.add');
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|alpha',
            ]
        );
        $category=new Category;
        $category->name=$request->input('name');
        $category->save();
        return redirect('/category');
    }


    public function show($id)
    {
        $category=Category::find($id);
        return view('Category.show')->with('category',$category);
    }


    public function edit($id)
    {
        $category=Category::find($id);
        return view('Category.edit')->with('category',$category);
    }


    public function update(Request $request, $id)
    {
        $category=Category::find($id);
        $this->validate($request,[
            'name'=>'required|alpha',
            ]
        );

        $category->name=$request->input('name');
        $category->id=$request->input('id');
        $category->save();
        return redirect('/category');
    }


    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect('/category');
    }
}
