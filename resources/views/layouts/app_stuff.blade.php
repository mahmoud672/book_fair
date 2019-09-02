<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"name="viewport"content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}">
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div class="h">
            <div class="logo">
                <div class="inner">
                    <span>hello</span>
                </div>
            </div>
            <div class="section-user">
                <h5 class="section-user-span">@if(Auth::guest())
                        {{"example@example.com"}}
                    @else
                        {{Auth::user()->email}}

                    @endif</h5>
                <nav>

                    @if (Auth::guest())
                        <li class="list-inline-item  badge"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="list-inline-item badge"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="list-inline-item badge"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    @endif
                </nav>
            </div>
        </div>
    </div>
    <div id="navbar">
        <div class="h n">
            <nav>
                <ul class="list-unstyled ">
                @if(Auth::guest())

                    @else
                    @if(Auth::user()->job_type=='publisher')
                            <li class="list-inline-item navLi mr-0"><a href="/reader"class="">home</a></li>
                        <li class="list-inline-item navLi mr-0"><a href="/reader/profile"class="">profile</a></li>
                      {{--  <li class="list-inline-item"><a href="/publisher"class="btn btn-light">publisher books</a></li>--}}
                        <li class="list-inline-item navLi mr-0"><a href="/book"class="">books</a></li>
                        <li class="list-inline-item navLi mr-0"><a href="/book/add"class="">add book</a></li>
                    @elseif(Auth::user()->job_type=='reader')
                        <li class="list-inline-item navLi mr-0"><a href="/reader"class="">home</a></li>
                        <li class="list-inline-item navLi mr-0"><a href="/reader/profile"class="">profile</a></li>
                        <li class="list-inline-item navLi mr-0"><a href="/book"class="">books</a></li>
                        <li class="list-inline-item navLi mr-0"><a href="/message"class="">message</a></li>
                    @elseif(Auth::user()->job_type=='admin')
                            <li class="list-inline-item navLi mr-0"><a href="/admin"class="">statistics</a></li>
                            <li class="list-inline-item navLi mr-0"><a href="/reader"class="">home</a></li>
                            <li class="list-inline-item navLi mr-0"><a href="/user"class="">user</a></li>
                            <li class="list-inline-item navLi mr-0"><a href="/category"class="">categories</a></li>
                            <li class="list-inline-item navLi mr-0"><a href="/category/add"class="">add category</a></li>
                            <li class="list-inline-item navLi mr-0"><a href="/admin/book"class="">show books</a></li>
                      {{--      <li class="list-inline-item"><a href="/admin/reader_book"class="btn btn-light">reader books</a></li>--}}
                            <!---<li class="list-inline-item"><a href="/book"class="btn btn-light">books</a></li>
                            <li class="list-inline-item"><a href="/book/add"class="btn btn-light">add book</a></li>---->
                    @endif
                @endif
                </ul>
                <div class="searchForm">
                    <form action="/search"method="post" class="form-inline">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <input type="text"name="search"value=""id="search"class="col-xl-9"placeholder="search ..."required>
                            <input type="submit"name="find"value="find"id="find"class="btn btn-primary col-xl-3">
                        </div>
                    </form>
                </div>
            </nav>

        </div>
    </div>

<!---<div id="slideshow">
    <div class="h">
    </div>
</div>---->
<div id="content">
    <div class="h">
        @yield('content')

    </div>
</div>

    <div id="footer">
        <div class="h n">
            <div class="sections">
                <h5>our objectives</h5>
                <ul>
                    <li>honesty</li>
                    <li>reality</li>
                    <li>Credibility</li>
                </ul>
            </div>
            <div class="sections">
                <h5>copy right</h5>
                <ul>
                    <li>mr fifty cent</li>
                    <li>MG</li>
                    <li>mahmoud gad</li>
                </ul>
            </div>
            <div class="sections border-right-0">
                <ul class="footer_icons border-right-0">
                    <li><img src="{{asset("images/facebook.png")}}"></li>
                    <li><img src="{{asset("images/1%20V7GYJQ_4lykfDzOf9q17eA.jpeg")}}"></li>
                    <li><img src="{{asset("images/social_youtube_2756.png")}}"></li>
                    <li><img src="{{asset("images/twitter.png")}}"></li>
                    <li><img src="{{asset("images/1491580629-yumminkysocialmedia03_83105.png")}}"></li>
                    <li><img src="{{asset("images/images.png")}}"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="{{asset("js/jquery-3.4.1.js")}}"></script>
<script src="{{asset("js/bootstrap.js")}}"></script>
<script src="{{asset("js/script.js")}}"></script>
</body>
</html>