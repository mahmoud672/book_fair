@extends("layouts.app_stuff")
@section("title")
    book-view-show
@endsection
@section('content')
    @if($message=Session::get('message'))

        <h5 class="alert alert-success text-center">{{$message}}</h5>

    @endif
    <div class="sliderNews"id="sliderNews">
        @if($lastEight->count() >0)
            @foreach($lastEight as $lastData)
                <div class="sliderNewsBlock">
                    <div class="newsHead">
                        <h5 data-id="">{{$lastData->title}}</h5>
                    </div>
                    <img src="{{asset("upload_images/$lastData->cover")}}">
                </div>
            @endforeach
        @else

        @endif

    </div>
    <div id="books-elements">
        <div class="column column-double float-left">
            <div class="books-elements-head-title head-show">
                <h4 class="head">{{$book->title}}</h4>
                 <span class="category">{{$book->category->name}}</span>
                By <span class="publisher">{{$book->publisher->name}}</span>
            </div>
            <div class="book-show-block">
                <div class="book-show-cover">
                    <a href="/book/{{$book->id}}/review"target="_blank" rel="noopener">
                        <img src="{{asset("upload_images/$book->cover")}}" class="image">
                    </a>
                </div>
                <div class="book-show-description">
                    <p>{{$book->description}}</p>
                </div>
                <div class="book-download-review">
                    {{--<a href="/book/{{$book->id}}/download"class="btn btn-primary">download</a>--}}
                    @if(Auth::user()->id==$book->publisher_id)
                        <a href="/book/{{$book->id}}/download"class="btn btn-primary">download</a>
                        <a href="/book/{{$book->id}}/review"target="_blank"rel="noopener" class="btn btn-danger">review</a>
                    @else
                        <form action="/book/{{$book->id}}/download"method="post"class="float-left">
                            <input type="hidden"name="_token"value="{{csrf_token()}}">
                            <input type="submit"name="button"value="download"class="btn btn-primary">
                        </form>
                        <form action="/book/{{$book->id}}/review"method="post">
                            <input type="hidden"name="_token"value="{{csrf_token()}}">
                            {{-- <input type="submit"name="button"value="download"class="btn btn-primary">--}}
                            <input type="submit"name="button"value="review"class="btn btn-danger">
                        </form>
                        {{--<a href="/book/{{$book->id}}/review"target="_blank"rel="noopener" class="btn btn-danger">review</a>--}}
                    @endif

                </div>
            </div>
            <div class="show-book-review-download">
                @php
                    $reviewResult=0;
                    $downloadResult=0;

                @endphp
                @if($booksReview->count() >0)

                    @foreach($booksReview as $bookReview)
                        @php
                            $reviewResult+=$bookReview->reading_times;
                        @endphp
                        @endforeach
                    @endif
                @if($booksDownload->count() >0)

                    @foreach($booksDownload as $bookDownload)
                        @php
                            $downloadResult+=$bookDownload->downloading_times;
                        @endphp
                    @endforeach
                @endif
                <span class="badge badge-info">reviews: {{$reviewResult}}</span>
                <span class="badge badge-success">downloads: {{$downloadResult}}</span>
            </div>
            <div class="book-rate">
                {{--<form action="/rate/add"method="post">
                    <input type="range"name="evaluation"id="evaluation"value=""min="0"max="5"oninput="outputEvaluation.value=evaluation.value"id="evaluation">
                    <output name="outputEvaluation" id="outputEvaluation"></output>
                    <input type="hidden"name="book_id"value="{{$book->id}}">
                    <input type="hidden"name="_token"value="{{csrf_token()}}">
                    <input type="submit"name="done"value="done"class="btn btn-primary">
                </form>--}}
                @if($rates->count() >0)
                    @php
                        $evaluation=0;
                        $count=0;
                    @endphp
                    @foreach($rates as $rate)
                        @php
                            $evaluation+=$rate->evaluation;
                            $count++;
                        @endphp
                    @endforeach
                    @for($i=0;$i<$evaluation/$count;$i++)
                        <img src="{{asset("images/star12.png")}}"class="star-image"id="first-star" alt="">
                        @endfor
                        <span class="badge badge-info">{{$evaluation/$count}}</span>
                    @else
                    <img src="{{asset("images/Star.png")}}"class="star-image"id="first-star" alt="">
                    <img src="{{asset("images/Star.png")}}"class="star-image"id="second-star" alt="">
                    <img src="{{asset("images/Star.png")}}"class="star-image"id="third-star" alt="">
                    <img src="{{asset("images/Star.png")}}"class="star-image"id="fourth-star" alt="">
                    <img src="{{asset("images/Star.png")}}"class="star-image"id="fifth-star" alt="">
                @endif
            </div>
            <div class="star-block">
                <img src="{{asset("images/Star.png")}}"class="star-image"id="first-star" alt="">
                <img src="{{asset("images/Star.png")}}"class="star-image"id="second-star" alt="">
                <img src="{{asset("images/Star.png")}}"class="star-image"id="third-star" alt="">
                <img src="{{asset("images/Star.png")}}"class="star-image"id="fourth-star" alt="">
                <img src="{{asset("images/Star.png")}}"class="star-image"id="fifth-star" alt="">
                <form action="/rate/add"method="post">
                    <input type="hidden"name="evaluation"id="evaluation"value=""min="0"max="5"id="evaluation">
                    <input type="hidden"name="book_id"value="{{$book->id}}">
                    <input type="hidden"name="_token"value="{{csrf_token()}}">
                    <input type="submit"name="done"value="done"class="btn btn-dark">
                </form>
            </div>

            {{--<div class="book-reader">
                <span class="alert alert-success"id="readerAddBook">add book</span>
                <form action=""method="post">
                    <input type="text"name="title"value=""placeholder="title"class="form-control"id="title">
                    <input type="text"name="author_name"value=""placeholder="author name"class="form-control"id="author_name">
                    <textarea name="description" id="description" class="form-text" placeholder="description..........">

                    </textarea>
                    <div class="form-group">
                        <label for="cover">cover:</label>
                        <input type="file"name="cover"class="form-control-file"id="cover">
                    </div>
                    <div class="form-group">
                        <label for="cover">book:</label>
                        <input type="file"name="book_link"class="form-control-file"id="book_link">
                    </div>

                    <input type="text"name="isbn"value=""class="form-control"id="isbn"placeholder="write isbn number">
                    <input type="submit"name="upload_book"value="upload"id="upload_book"class="btn btn-primary">
                </form>
            </div>--}}
            <div class="book-reader-comments">
                <div class="book-comment">
                    <form action="/book/comment/add"method="post" class="comment-form">
                        <input type="text"name="content"value=""class="form-text contentCommentBook"placeholder="comment ...">
                        <input type="hidden"name="book_id"value="{{$book->id}}">
                        <input type="hidden"name="_token"value="{{csrf_token()}}">
                        <input type="submit"name="addCommentBook"value="add"class="btn btn-primary CommentBookBtn"id="addCommentBook">
                    </form>
                </div>
                @if($bookComments->count()>0)
                    @foreach($bookComments as $bookComment)
                        <div class="book-comment">
                            <p class="userName_comment">{{$bookComment->user->email}}</p>
                            <form action="/book/comment/edit"method="post" class="comment-form">
                                <input type="hidden"name="comment_id"value="{{$bookComment->id}}">
                                <input type="hidden"name="book_id"value="{{$bookComment->book_id}}">
                                <input type="hidden"name="_token"value="{{csrf_token()}}">
                                @if($bookComment->user_id==Auth::user()->id)
                                    <input type="text"name="content"value="{{$bookComment->content}}"class="form-text contentCommentBook showing-comment-owner"readonly placeholder="comment ...">
                                    <a href="/book/comment/delete/{{$bookComment->id}}"class="btn btn-danger deletecomment">del</a>
                                    <input type="submit"name="updateCommentBook"value="edit"class="btn btn-primary CommentBookBtn"id="updateCommentBook">
                                    @else
                                    <input type="text"name="content"value="{{$bookComment->content}}"class="form-text contentCommentBook showing-comment-user"readonly placeholder="comment ...">
                                @endif
                            </form>
                        </div>
                        @endforeach
                    @else
                    <p class="text-center">no comments</p>
                    @endif
            </div>
        </div>

        <div class="coloumn float-right">
            <div class="books-elements-head-title">
                <h4 class="head">All Our Books</h4>
            </div>
            <div class="book-reader">
                @if($errors->any()>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            <span>{{$error}}</span>
                        </div>
                    @endforeach
                @else
                @endif
                <span class="alert alert-success"id="readerAddBook">add book</span>

                <form action="/book/add"method="post"enctype="multipart/form-data">
                    <input type="text"name="title"value=""placeholder="title"class="form-control"id="title">
                    <input type="text"name="author_name"value=""placeholder="author name"class="form-control"id="author_name">
                    <textarea name="description" id="description" class="form-text" placeholder="description..........">

                    </textarea>
                    <div class="form-group">
                        <label for="cover">cover:</label>
                        <input type="file" name="cover" class="form-control-file"id="cover">
                    </div>
                    <div class="form-group">
                        <label for="book_link">book:</label>
                        <input type="file" name="book_link" class="form-control-file"id="book_link">
                    </div>
                    <div class="form-group">
                        <label for="category">category</label>
                        <select name="category_id" id="category_id">
                            <option value="1">fiction</option>
                            <option value="3">advinture</option>
                        </select>
                    </div>
                    <input type="text"name="isbn"value=""class="form-control"id="isbn"placeholder="write isbn number">
                    <input type="hidden"name="_token"value="{{csrf_token()}}">
                    <input type="hidden"name="publisher_id"value="2">
                    <input type="submit"name="upload_book"value="upload"id="upload_book"class="btn btn-primary">
                </form>
            </div>
            @if($books->count() > 0)
                @foreach($books as $book)
                    @if($book->status==1)
                        <div class="book-block">
                            <div class="book-block-cover"><a href="/book/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                            <div class="bestof-content">
                                <p class="book-block-title"><a href="/book/show/{{$book->id}}">{{$book->title}}</a></p>
                                <p class="book-block-publisher"><a href="/user/profile/{{$book->publisher_id}}"class="text-black-50">{{$book->publisher->name}}</a></p>
                                <p class="book-block-category">{{$book->category->name}}</p>
                            </div>
                            <div class="rate-revew-download">
                                <span class="badge badge-danger">rate:{{$book->rate->avg('evaluation')}}</span>
                                <span class="badge badge-info">reviews:{{$book->review->sum('reading_times')}}</span>
                                <span class="badge badge-success">downloads:{{$book->download->sum('downloading_times')}}</span>
                            </div>
                        </div>
                @endif
            @endforeach
        @else

        @endif


        </div>


    </div>
@endsection