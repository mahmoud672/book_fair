@extends("layouts.app_stuff")
@section('title')
    publisher-home
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
            <div class="sliderNewsBlock">

                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
                <img src="{{asset("images/typewriter-1227357_960_720.jpg")}}">
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
                <img src="{{asset("images/typewriter-1227357_960_720.jpg")}}">
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
                <img src="{{asset("images/typewriter-1227357_960_720.jpg")}}">
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
                <img src="{{asset("images/typewriter-1227357_960_720.jpg")}}">
            </div>
        @endif


    </div>
    <button class="leftSlide l"> < </button>
    <button class="rightSlide r"> > </button>

   <div id="books-elements">
        <div class="coloumn">
            <div class="books-elements-head-title">
                <h4 class="head">Our Best newset books</h4>
            </div>
            @if($books->count() > 0)
                @foreach($books as $book)
                    @if($book->status==1)
                        <div class="book-block">
                            <div class="book-block-cover"><a href="/publisher/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                            <div class="bestof-content">
                                <p class="book-block-title"><a href="/publisher/show/{{$book->id}}">{{$book->title}}</a></p>
                                <p class="book-block-publisher">{{$book->publisher->name}}</p>
                                <p class="book-block-category">{{$book->category->name}}</p>
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
               <h4 class="head">All Our Books</h4>
           </div>
           @if($books->count() > 0)
               @foreach($books as $book)
                   @if($book->status==1)
                       <div class="book-block">
                           <div class="book-block-cover"><a href="/publisher/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                           <div class="bestof-content">
                               <p class="book-block-title"><a href="/publisher/show/{{$book->id}}">{{$book->title}}</a></p>
                               <p class="book-block-publisher">{{$book->publisher->name}}</p>
                               <p class="book-block-category">{{$book->category->name}}</p>
                           </div>
                       </div>
                   @endif
               @endforeach
           @else

       @endif

       <!----->
       </div>
       <div class="coloumn">
           <div class="books-elements-head-title">
               <h4 class="head">books for selling</h4>
           </div>
           @if($books->count() > 0)
               @foreach($books as $book)
                   @if($book->status==1)
                       <div class="book-block">
                           <div class="book-block-cover"><a href="/publisher/show/{{$book->id}}"><img src="{{asset("upload_images/$book->cover")}}" alt=""></a></div>
                           <div class="bestof-content">
                               <p class="book-block-title"><a href="/publisher/show/{{$book->id}}">{{$book->title}}</a></p>
                               <p class="book-block-publisher">{{$book->publisher->name}}</p>
                               <p class="book-block-category">{{$book->category->name}}</p>
                           </div>
                       </div>
                   @endif
               @endforeach
           @else

       @endif

       <!----->
       </div>
       <!----->

    </div>
@endsection