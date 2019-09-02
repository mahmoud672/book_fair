@extends('layouts.app_stuff')
@section('title')
    Category-view-edit
@endsection
@section('content')
    <div class="myForm half padd">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="/category/edit/{{$category->id}}"method="post">
                <div class="form-group ">
                    <label for="name">category name</label>
                    <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control"placeholder="Type Name" >
                </div>
                <input type="hidden"name="id"value="{{$category->id}}">
                <input type="hidden"name="_token"value="{{csrf_token()}}">
                <input type="submit" name="update" value="update" class="btn btn-danger"
                       id="update">
            </form>
    </div>
@endsection