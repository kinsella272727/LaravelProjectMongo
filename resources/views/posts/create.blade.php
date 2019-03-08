@extends('layouts.app')

@section('content')
  <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
        {{form::label('title')}}
        {{form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
      </div>
      <div class="form-group">
        {{form::label('body')}}
        {{form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
      </div>
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      <div class="form-group">
        {{form::label('category_id', 'Category:')}}
        <select class="form-control" name="category_id">
          @foreach($categories as $category)
            <option value='{{ $category->id}}'>{{ $category->name }}</option>
          @endforeach
        </select>

        {{form::label('tags', 'Tags:')}}
        <select class="form-control select2-multi" name="tags[]" id="tags" multiple="multiple">
          @foreach($tags as $tag)
            <option value='{{ $tag->id}}'>{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>
      {{form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
