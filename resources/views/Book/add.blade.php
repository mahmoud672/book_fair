@extends("layouts.app_stuff")
@section("title")
    news-view-add
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
           @if($upload_error=Session::get('upload_error'))
               <p class="alert alert-danger text-center">{{$upload_error}}</p>
           @else
           @endif


        <form action="/book/add" method="post"enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {!! csrf_field() !!}
            <div class='form-group'>
                <label for="title">book title</label>
                <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control" >
            </div>
            <div class="form-group">
                <label for="description">book description</label>
                  <textarea name='description' id='description' class="form-control">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="cover">choose an image as cover :</label>
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
                            <option value="{{ $category->id }}">{{$category->name}}</option>
                         @endforeach
                     @else
                        <option value="">----------- no category to show ------------</option>
                    @endif
                </select>
            </div>

            <input type="hidden" name="publisher_id" value="2"id="publisher_id">

            <input type="submit" name="addBook" value="add book" class="btn btn-danger" id="addBook">
        </form>
    </div>
@endsection