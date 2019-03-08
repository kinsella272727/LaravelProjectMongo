@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-primary">Go Back</a>
  <h1>{{$post->title}}</h1>
  <img style="width:100%" src="/storage/cover_image/{{$post->cover_image}}">
  <br> <br>
  <div>
    {{$post->body}}
  </div>
  <p>Category: {{ $post->category->name}}</p>
  <hr>
  <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
  <hr>
  @if(!Auth::guest())

    <div class="row">
      <div class="col-md-8">
        @foreach($post->comments as $comment)
          <div class="comment">
            <p><strong>Comment:</strong> <br/>{{ $comment->comment}}</p>
          </div>
        @endforeach
      </div>
    </div>

    <div class="row">
      <div class="comment-form">
        {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

          <div class="row">
            <div class="col-md-12">
              {{ Form::label('comment', "Comment:") }}
              {{ Form::textarea('comment', null, ['class' => 'form-control']) }}

              {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;'])}}
            </div>
          </div>

        {{ Form::close()}}
      </div>
    </div>

    @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close() !!}
    @endif
  @endif
@endsection
