@extends('layouts.app_stuff');
@section('title')
    users
@endsection
@section('content')
    <div class='myTable'>
        <table class='table table-bordered'>
            <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>job type</th>
                <th>phone</th>
                <th>delete</th>
                <th>show</th>
            </tr>
            </thead>
            <tbody id="myTbody">
                @if(isset($users))
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->job_type}}</td>
                            <td>{{$user->phone}}</td>
                            <td><a href="/user/delete/{{$user->id}}"class="btn btn-danger">Delete</a></td>
                            <td><a href="/user/show/{{$user->id}}"class="btn btn-primary">Show</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="8">no data to show</td></tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection