@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Book fair</div>

                <div class="panel-body">
                    <div class="container" >
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-body"style="height: 1000px;background-color: #faebcc">

                                        <div id="content" style="width: 800px;background-color: #f6f6f6" >
                                            <div style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #4AF4FE;">
                                                <h1 class="title">Welcome to Our Website!</h1>
                                                <p><img src="{{asset("images/book-fair.jpg")}}" alt="" class="left" height="160" width="200"></p>
                                                <p><strong>book fair</strong> One web page for every book ever published. It's a lofty but achievable goal.

                                                    To build Open Library, we need hundreds of millions of book records, a wiki interface, and lots of people who are willing to contribute their time and effort to building the site.</p>
                                                <h2>read more</h2>
                                                <p>To date, we have gathered over 20 million records from a variety of large catalogs as well as single contributions, with more on the way.

                                                    Open Library is an open project: the software is open, the data are open, the documentation is open, and we welcome your contribution</p>
                                                <blockquote>
                                                    <p>“Integer nisl risus, sagittis convallis, rutrum id, elementum congue, nibh. Suspendisse dictum porta lectus. Donec placerat odio vel elit. Nullam ante orci, pellentesque eget.”</p>
                                                </blockquote>
                                            </div>
                                            <div>&nbsp;</div>
                                            <div class="twocols" style="height: 500px">
                                                <div class="col1">
                                                    <h3 class="title">Top 12 websites to download free books online</h3>

                                                    <li>Open Library. ...</li>
                                                    <li>Project Gutenberg. ...</li>
                                                    <li>ManyBooks. ...</li>
                                                    <li>Bookboon. ...</li>
                                                    <li>Feedbooks. ...</li>
                                                    <li>Free-eBooks. ...</li>
                                                    <li>LibriVox. ...</li>
                                                    <li>Smashwords.</li>

                                                </div>
                                                <div class="col2">
                                                    <h3 class="title">the quation which the people asked </h3>
                                                    <ul class="list">
                                                        <ol>How do I borrow books from the library online?</ol>
                                                        <ol>Where can I read books online for free?</ol>
                                                        <ol>Are there any free online libraries?</ol>
                                                        <ol>Does my library use OverDrive?</ol>
                                                        <ol>Is Open Library free?</ol>
                                                        <ol>Where can I download free best seller books?</ol>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end content -->
                                        <!-- end sidebar -->
                                        <div style="clear: both;">&nbsp;</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
