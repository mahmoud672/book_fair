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
                                <p class="book-block-publisher"><a href="/user/profile/{{$book->publisher_id}}"class="text-black-50">{{$book->publisher->name}}</a></p>
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
            <div class="books-elements-head-title">
                <h4 class="head">messages and send</h4>
            </div>
        <!--------- send message ------>
            <div class="message-form">
                @if($message=Session::get('message'))
                    <p class="alert badge badge-danger message-afterTransmition">{{$message}}</p>
                    @else
                    @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @else
                    @endif
                <form action="/message/add"method="post">
                    <input type="text"name="receiver_email"value=""placeholder="Receiver E-Mail"class="form-control"id="message_reciever">
                    <input type="text"name="title"value=""placeholder="message title"class="form-control"id="message_title">
                    <textarea name="content"id="message_content"placeholder="message content"></textarea>
                    <input type="hidden"name="_token"value="{{csrf_token()}}">
                    <input type="submit"name="sendMessage"value="send message"id="sendMessage"class="btn btn-primary">
                </form>
            </div>
            <!----->
        </div>
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">All your messages</h4>
            </div>
            @if($messages->count() > 0)
                @foreach($messages as $userMessage)
                    <div class="senderAndReceiver">
                        <span class="alert badge badge-light">{{$userMessage->sender->name}}</span>
                        to:<span class="alert badge badge-light">{{$userMessage->receiver->name}}</span>
                    </div>
                    <h5 class="messageTitle">{{$userMessage->title}}</h5>
                    <p class="messageContent">{{$userMessage->content}}</p>
                    @endforeach
                @else
                <p>no messages to show</p>
                @endif

            @foreach($users as $user)

                <span>{{$user->senderMessage}}</span>
        @endforeach
        <!----->
        </div>
        <!----->

    </div>
@endsection