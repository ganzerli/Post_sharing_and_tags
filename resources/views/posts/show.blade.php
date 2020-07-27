@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
    
         <div class="col-12 col-md-8 offset-md-2">
             <div class="card">
               <div class="card-header">
                 {{$post->title}}
               </div>
               <div class="card-body">
                 <h5 class="card-title">{{$post->slug}}</h5>
                 <p class="card-text">{{$post->body}}</p>

                 <div class="tags">
                  @foreach($post->tags as $tag)
                  <small class="mx-2 text-primary">
                  <a href="{{route('posts.tagIndex',['tag'=>$tag])}}">{{$tag->name}}</a>
                  </small>
                  @endforeach
                </div>

                @if(Auth::id() == $post->user_id)
                 <a href="#" class="btn btn-info">Modifica</a>
                 <form action="{{route('posts.destroy' , ['post'=>$post])}}" method="post" class="d-inline-block">
                 @csrf
                 @method('DELETE')
                     <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
                @endif
               </div>
             </div>
         </div>


    </div>
</div>

@endsection