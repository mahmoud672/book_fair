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
                <th>name</th>
                <th>email</th>
                <th>job type</th>
                <th>phone</th>
            </tr>
            </thead>
            <tbody id="myTbody">
            @if(isset($user))
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->job_type}}</td>
                        <td>{{$user->phone}}</td>
                    </tr>
            @else
                <tr><td colspan="5">no data to show</td></tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection