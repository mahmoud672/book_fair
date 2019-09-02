@extends('layouts.app_stuff');
@section('title')
    Editor-view-show
@endsection
@section('content')
    <div class='myTable'>
        <table class='table table-bordered'>
            <thead>
            <tr>
                <th>id</th>
                <th>category name</th>
                <th>creation date</th>
            </tr>
            </thead>
            <tbody id="myTbody">
            @if(isset($category))
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at}}</td>
                    </tr>
            @else
                <tr><td colspan="8">no data to show</td></tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection