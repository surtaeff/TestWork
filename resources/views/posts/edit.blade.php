@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
     @foreach ($errors->all() as $error)
     <div class="alert alert-danger">{{$error}}</div>
     @endforeach
 @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактирование записи: <b>{{$post->id.' - '.$post->title}}</b></div>
               

                <div class="card-body">
                <form method="post" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
    <label>Название</label>
    <input type="text" class="form-control" placeholder="Введите название записи" value="{{ $post->title }}" name="title">
  </div>
  <div class="form-group">
    <label>Категория</label>

    <select name="category_id" class="form-control">
      <option value="0">Без категории</option>
    @if($categories->count())
    @foreach($categories as $category)
    <option {{ $category->id == $post->category_id ? "selected" : "" }} value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
    @endif
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Изображение</label>
    <input type="file" name="image" class="form-control" placeholder="image">
    <img src="/image/{{ $post->image }}" width="300px">
  </div>

  <button type="submit" class="btn btn-success">Редактировать</button>
  <a href="{{route('posts.index')}}" class="btn btn-primary">Назад</a>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
