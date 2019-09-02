@extends("layouts.app_stuff")
@section('title')
    reader-home
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
    <button class="leftSlide l"> < </button>
    <button class="rightSlide r"> > </button>
    <div id="books-elements">
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">Our Best newest books</h4>
            </div>
            @if($lastEight->count() > 0)
                @foreach($lastEight as $book)
                    @if($book->status==1)
                        <div class="book-block">
                            <div class="book-block-cover"><a href="/book/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                            <div class="bestof-content">
                                <p class="book-block-title"><a href="/book/show/{{$book->id}}">{{$book->title}}</a></p>
                                <p class="book-block-publisher">{{$book->publisher->name}}</p>
                                <p class="book-block-category">{{$book->category->name}}</p>
                            </div>
                            <div class="rate-revew-download">
                                <span class="badge rrd"><img src="{{asset('images/star12.png')}}">:{{$book->rate->avg('evaluation')}}</span>
                                <span class="badge  rrd"><img src="{{asset('images/eye.png')}}">:{{$book->review->sum('reading_times')}}</span>
                                <span class="badge rrd"><img src="{{asset('images/download1.png')}}">:{{$book->download->sum('downloading_times')}}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else

            @endif


        </div>
        <!----->
        <div class="coloumn">

        <!--------- posts ------>
            <div class="books-elements-head-title">
                <h4 class="head">posts and comments</h4>
            </div>
            <div class="book-block">
                <form action="/post/add"method="post"class="postForm">
                    <div class="form-group post-group">
                        <textarea name="content"placeholder="what are you thinking of ... "class="form-text postContent"></textarea>
                        <input type="hidden"name="_token"value="{{csrf_token()}}">
                        <input type="submit"name="addPost"value="post"id="addPost"class="btn btn-primary">
                    </div>
                </form>
            </div>
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="book-block post-edit-block">
                        <form action="/post/edit"method="post"class="postForm">
                            <div class="form-group post-group">
                                @if(!Auth::guest())
                                    @if(Auth::user()->id==$post->user_id)
                                        <p class="userName_post">{{$post->user->email}}</p>
                                        <textarea name="content"class="form-text postContent postContent-owner"readonly>{{$post->content}}</textarea>
                                        <input type="hidden"name="post_id"value="{{$post->id}}">
                                        <input type="hidden"name="_token"value="{{csrf_token()}}">
                                        <a href="/post/delete/{{$post->id}}"class="btn btn-danger deletePost">del</a>
                                        <input type="submit"name="manipulatePost"value="edit"class="btn btn-dark editPost">
                                    @else
                                        <p class="userName_post">{{$post->user->email}}</p>
                                        <textarea name="content"class="form-text postContent postContent-user"readonly>{{$post->content}}</textarea>
                                        <input type="hidden"name="post_id"value="{{$post->id}}">
                                        <input type="hidden"name="_token"value="{{csrf_token()}}">
                                    @endif
                                @endif

                            </div>
                        </form>
                    </div>
                    <div class="comments-block">
                        <div class="comment">
                            <form action="/comment/add"method="post" class="comment-form">
                                <input type="text"name="content"value=""class="form-text"placeholder="comment ...">
                                <input type="hidden"name="post_id"value="{{$post->id}}">
                                <input type="hidden"name="_token"value="{{csrf_token()}}">
                                <input type="submit"name="addComment"value="add"class="btn btn-primary">
                            </form>
                        </div>

                        @if($comments->count() >0)
                            @foreach($comments as $comment)
                                @if($comment->post_id==$post->id)
                                    <div class="comment">
                                        <p class="userName_comment">{{$comment->user->email}}</p>
                                        <form action="/comment/edit"method="post" class="comment-form">

                                            <input type="hidden"name="comment_id"value="{{$comment->id}}">
                                            <input type="hidden"name="post_id"value="{{$post->id}}">
                                            <input type="hidden"name="_token"value="{{csrf_token()}}">
                                            @if($comment->user_id==Auth::user()->id)
                                                <input type="text"name="content"value="{{$comment->content}}"class="form-text showing-comment-owner"placeholder="comment ..."readonly>
                                                <a href="/comment/delete/{{$comment->id}}"class="btn btn-danger deletecomment">del</a>
                                                <input type="submit"name="editComment"value="edit"class="btn btn-success">
                                            @else
                                                <input type="text"name="content"value="{{$comment->content}}"class="form-text showing-comment-user"placeholder="comment ..."readonly>
                                            @endif

                                        </form>
                                    </div>
                                @else
                                @endif

                            @endforeach
                        @else
                        @endif

                    </div>
            @endforeach
        @else

        @endif
            <!----->
        </div>
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">your search result</h4>
            </div>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <span class="alert alert-danger">{{ $error }}</span>
                        @endforeach
                    @endif
                @if(isset($books))
                    @foreach($books as $book)
                        @if($book->status==1)
                            <div class="book-block">
                                <div class="book-block-cover"><a href="/book/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                                <div class="bestof-content">
                                    <p class="book-block-title"><a href="/book/show/{{$book->id}}">{{$book->title}}</a></p>
                                    <p class="book-block-publisher">{{$book->publisher->name}}</p>
                                    <p class="book-block-category">{{$book->category->name}}</p>
                                </div>
                                <div class="rate-revew-download">
                                    <span class="badge rrd"><img src="{{asset('images/star12.png')}}">:{{$book->rate->avg('evaluation')}}</span>
                                    <span class="badge  rrd"><img src="{{asset('images/eye.png')}}">:{{$book->review->sum('reading_times')}}</span>
                                    <span class="badge rrd"><img src="{{asset('images/download1.png')}}">:{{$book->download->sum('downloading_times')}}</span>
                                </div>
                            </div>
                    @endif
                @endforeach
            @else
                <p class="alert alert-danger text-center">no matched result</p>

            @endif

            <!----->
        </div>
        <!----->

    </div>
@endsection