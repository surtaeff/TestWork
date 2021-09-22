@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Просмотр</a> {{$post->title}}</div>
              
                <div class="card-body">
              <p><b>Категория: <b> {{$post->category->category_name}}</a></p>
              <p><b>Автор: <b>
              @can('isManager')
              <a href="{{route('posts.index',['user_id'=>$post->user->id])}}" title="Просмотреть все записи автора {{$post->user->name}}">{{$post->user->name}}</a>
                    @elsecan('isEmployee')
                    {{$post->user->name}}
                    @endcan
                    </p>
              
              <div class="text-center">
                    <img src="/image/{{ $post->image }}" class="rounded" width="300px">
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
