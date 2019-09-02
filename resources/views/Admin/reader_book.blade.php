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
                <!--<th>cover</th>
                <th>link</th>---->
                <th>book</th>
                <th>review</th>
                <th>category</th>
                <th>publisher</th>
                <th>status</th>
                <th>action</th>
                <th>delete</th>
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
                        <!---<td><img src="{{asset("upload_images/$book->cover")}}" alt=""class="imageTable"></td>
                        <td><a href="{{route("book.download",$book->id)}}">{{$book->book_link}}</a></td>---->
                        <td><a href="{{route("bookReader.download",$book->id)}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""class="imageTable"></a></td>
                        <td><a href="{{route("bookReader.review",$book->id)}}">review</a></td>
                        <td>{{$book->category->name}}</td>
                        <td>{{$book->reader->name}}</td>
                        <td>{{$status}}</td>
                        <td>
                            <form action="/admin/reader_book"method="post">
                                <select name="status" id="status">
                                    <option value="0">pending</option>
                                    <option value="1">approved</option>
                                    <option value="2">disapproved</option>
                                </select>
                                <input type="hidden"name="book_id"value="{{$book->id}}">
                                <input type="hidden"name="_token"value="{{csrf_token()}}">
                                <input type="submit"name="apply"value="applay"id="applay"class="btn btn-success">
                            </form>
                        </td>
                        <td><a href="/book/delete/{{$book->id}}"class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="7">no book to show</td></tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection