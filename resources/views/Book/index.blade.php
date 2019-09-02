@extends("layouts.app_stuff")
@section("title")
    news-view
@endsection
@section('content')
    <div class='myTable padd '>
        <table class='table table-bordered'>
            <thead class="thead-dark">
            <tr>
                <th>title</th>
                <th>description</th>
                <th>cover</th>
                <th>link</th>
                <th>review</th>
                <th>category</th>
                <th>publisher</th>
                <th>status</th>
                <th>delete</th>
                <th>edit</th>
                <th>show</th>
            </tr>
            </thead>
            <tbody id="myNewsTbody">
                @if($books->count() >0)
                    @foreach($books as $book)
                        @if($book->status==0)
                            @php $status='pending' @endphp
                         @elseif($book->status==1)
                            @php $status='approved' @endphp
                        @elseif($book->status==2)
                            @php $status='disapproved' @endphp
                        @endif
                        <tr>
                            <td>{{$book->title}}</td>
                            <td>{{$book->description}}</td>
                            <td><img src="{{asset("upload_images/$book->cover")}}" alt=""class="imageTable"></td>
                            <td><a href="{{route("book.download",$book->id)}}">download</a></td>
                            <td><a href="{{route("book.review",$book->id)}}">review</a></td>
                            <td>{{$book->category->name}}</td>
                            <td>{{$book->publisher->name}}</td>
                            <td>{{$status}}</td>
                            <td><a href="/book/delete/{{$book->id}}"class="btn btn-danger">Delete</a></td>
                            <td><a href="/book/edit/{{$book->id}}"class="btn btn-dark">Edit</a></td>
                            <td><a href="/book/show/{{$book->id}}"class="btn btn-primary">Show</a></td>
                        </tr>
                    @endforeach    
                @else
                    <tr><td colspan="7">no book to show</td></tr>
                @endif    
            </tbody>
        </table>
    </div>
@endsection