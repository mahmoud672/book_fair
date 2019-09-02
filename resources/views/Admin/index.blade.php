@extends("layouts.app_stuff")
@section("title")
    Admin-statistics
@endsection
@section('content')
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
    <div id="statistics">
        <div class="statistics_box">
            <div class="statistics_box_head">
                <h4>users</h4>
            </div>
            <div class="statistics_box_body">
                <div class="statistics_box_body_image">
                    <img src="{{asset("images/user.jpg")}}"/>
                </div>
            </div>
            <div class="statistics_box_bottom">
                <h5>{{$usersCount}} user(s)</h5>
            </div>
        </div>
        <div class="statistics_box">
            <div class="statistics_box_head">
                <h4>categories</h4>
            </div>
            <div class="statistics_box_body">
                <div class="statistics_box_body_image">
                    <img src="{{asset("images/Categories.jpg")}}"/>
                </div>
            </div>
            <div class="statistics_box_bottom">
                <h5>{{$categoriesCount}} categories</h5>
            </div>
        </div>
        <div class="statistics_box">
            <div class="statistics_box_head">
                <h4>books</h4>
            </div>
            <div class="statistics_box_body">
                <div class="statistics_box_body_image">
                    <img src="{{asset("images/books.jpg")}}"/>
                </div>
            </div>
            <div class="statistics_box_bottom">
                <h5>{{$booksCount}} book(s)</h5>
            </div>
        </div>
    </div>
@endsection