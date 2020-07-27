@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
        @if($errors->any())
            @foreach($errors->all() as $err)
               <p class="text-danger">{{$err}}</p> 
            @endforeach
        @endif

        @if(session('message'))
               <p class="text-success">{{session('message')}}</p>
               <a href="{{route('posts.index')}}">Lista Post</a>
        @endif
       
        <form method="post" action="{{route('posts.store')}}">
        @csrf
            <div class="form-group">
              <label for="title">Titolo</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Titolo">
            </div>
            <div class="form-group">
              <label for="slug">Sottotitolo</label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="Titolo">
            </div>
            <div class="form-group">
                <label for="text">Testo</label>
                <textarea class="form-control" id="body" name="body" rows="5"></textarea>
            </div>
     
            @foreach($tags as $tag)
                <div class="mx-3 d-inline-block">
                    <input type="checkbox" name="{{$tag->name}}" value="{{$tag->name}}" class="form-check-input" id="{{$tag->name}}">
                    <label class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>
                </div>
            @endforeach
 
            <div class="form-group">
                <button type="submit" class="btn btn-success">crea post</button>
            </div>
        </div>
    </div>
</div>


@endsection