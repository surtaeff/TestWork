@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создание записи</div>
               

                <div class="card-body">
                <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
    <label>Название</label>
    <input type="text" class="form-control" placeholder="Введите название записи" value="{{ old('title') }}" name="title">
  </div>
  <div class="form-group">
    <label>Категория</label>

    <select name="category_id" class="form-control">
      <option value="0">Без категории</option>
    @if($categories->count())
    @foreach($categories as $category)
    <option {{ old('category_id') == $category->id ? "selected" : "" }} value="{{$category->id}}">{{$category->category_name}}</option>
    @endforeach
    @endif
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Изображение</label>
    <input type="file" name="image" class="form-control" placeholder="image">
  </div>


  <button type="submit" class="btn btn-success">Добавить</button>
  <a href="{{route('posts.index')}}" class="btn btn-primary">Назад</a>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
