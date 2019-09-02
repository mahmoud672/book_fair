@extends("layouts.app_stuff")
@section("title")
    news-view-edit
@endsection
@section('content')
    <div class="myForm half">
        @if($errors->count() >0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <ul>
                        <li>{{$error}}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <form action="/book/edit/{{$book->id}}" method="post"enctype="multipart/form-data">
            <div class='form-group'>
                <label for="title">book title</label>
                <input type="text" name="title" id="title" value="{{$book->title}}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="description">book description</label>
                <textarea name='description' id='description' class="form-control">{{$book->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="cover">choose an image :</label>
                <input type="file"name="cover"id="cover"class="form-control-file">
            </div>
            <div class="form-group">
                <label for="book_link">choose the book you want to upload :</label>
                <input type="file"name="book_link"id="book_link"class="form-control-file">
            </div>
            <div class="form-group">
                <label for="category_id">category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">----------- select category ------------</option>
                    @if($categories->count() >0)
                        @foreach($categories as $category)
                            @if($category->id=$book->category_id)
                                <option value="{{ $category->id }}"selected>{{$category->name}}</option>
                            @else
                                <option value="{{ $category->id }}">{{$category->name}}</option>
                            @endif

                        @endforeach
                    @else
                        <option value="">----------- no category to show ------------</option>
                    @endif
                </select>
            </div>

            <input type="hidden" name="publisher_id" value="2" id="publisher_id">
            <input type="hidden" name="id" value="{{$book->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" name="updateBook" value="update book" class="btn btn-danger" id="updateBook">
        </form>
    </div>
@endsection