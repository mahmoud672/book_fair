@extends('layouts.app_stuff');
@section('title')
    Category-view
@endsection
@section('content')
    <div class='myTable'>
        <table class='table table-bordered'>
            <thead>
            <tr>
                <th>category name</th>
                <th>creation date</th>
                <th>delete</th>
                <th>edit</th>
                <th>show</th>
            </tr>
            </thead>
            <tbody id="myTbody">
                @if(isset($categories))
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at}}</td>
                            <td><a href="/category/delete/{{$category->id}}"class="btn btn-danger">Delete</a></td>
                            <td><a href="/category/edit/{{$category->id}}"class="btn btn-dark">Edit</a></td>
                            <td><a href="/category/show/{{$category->id}}"class="btn btn-primary">Show</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="8">no data to show</td></tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection