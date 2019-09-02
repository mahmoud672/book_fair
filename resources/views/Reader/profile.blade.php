@extends("layouts.app_stuff")
@section('title')
    profile
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
                <h4 class="head">your uploads</h4>
            </div>
            @if($books->count() > 0)
                @foreach($books as $book)
                    @if($book->status==1)
                        <div class="book-block">
                            <div class="book-block-cover"><a href="/book/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                            <div class="bestof-content">
                                <p class="book-block-title"><a href="/book/show/{{$book->id}}">{{$book->title}}</a></p>
                                <p class="book-block-publisher">{{$book->author_name}}</p>
                                <p class="book-block-category">{{$book->category->name}}</p>
                                <p class="book-block-uploadedBy"><a href="/user/profile/{{$book->publisher_id}}"class="text-black-50">{{$book->publisher->name}}</a></p>

                            </div>

                        </div>
                    @endif
                @endforeach
            @else

            @endif


        </div>
        <!----->
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">all your posts </h4>
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
            @if($reader_posts->count() > 0)
                @foreach($reader_posts as $post)
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
        <!--------- posts ------>

            <!----->
        </div>
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">your information</h4>
            </div>
            <div class="personal-info">
                <div class="personal-info-form">
                    @if($message=Session::get('messageProfile'))
                        <p class="alert alert-danger">{{$message}}</p>
                        @else
                        @endif
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger text-center">{{$error}}</p>
                            @endforeach
                        @else
                        @endif
                    <form action=""method="post">
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text"name="name"value="{{$personal_info->name}}"id="name"class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text"name="email"value="{{$personal_info->email}}"id="email"class="form-control"readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password"name="password"value=""id="password"class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="retype_password">retype password</label>
                            <input type="password"name="retype_password"value=""id="retype_password"class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">phone</label>
                            <input type="text"name="phone"value="{{$personal_info->phone}}"id="phone"class="form-control">
                            <label for="show-hide-phone">show/hide phone number</label>
                            @if($personal_info->phone_status==0)
                                <label for="hide-phone">hide</label>
                                <input type="radio"name="show_hide_phone"value="0"checked>
                                <label for="show-phone">show</label>
                                <input type="radio"name="show_hide_phone"value="1">
                            @else
                                <label for="hide-phone">hide</label>
                                <input type="radio"name="show_hide_phone"value="0">
                                <label for="show-phone">show</label>
                                <input type="radio"name="show_hide_phone"value="1"checked>
                            @endif


                        </div>
                        <input type="hidden"name="_token"value="{{csrf_token()}}">
                        <input type="submit"name="edit_info"value="edit info"id="edit_info"class="btn btn-primary ">
                    </form>
                </div>
            </div>
        <!----->
        </div>
        <!----->

    </div>
@endsection