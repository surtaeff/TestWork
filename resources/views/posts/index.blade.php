@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Записи</div>
                @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('primary'))
    <div class="alert alert-primary">
        {{ session()->get('primary') }}
    </div>
@endif
@if(session()->has('danger'))
    <div class="alert alert-danger">
        {{ session()->get('danger') }}
    </div>
@endif

                <div class="card-body">
                <a href="{{route('posts.create')}}" class="btn btn-success right">Добавить</a>
                <br><br>
                @if($posts->count())
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Изображение</th>
      <th scope="col">Пользователь</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($posts as $post)
  <tr>
      <td scope="row">{{ $post->id }}</td>
      <td>{{ $post->title }}</td>
      <td scope="row"><img class="rounded mx-auto d-block" src="/image/{{ $post->image }}" height="100px"></td>
      <td scope="row">{{$post->user->name . ' ('.$post->user->email.')'}}</td>
      <td scope="row">
      <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
            @csrf
            @method('DELETE')
                    <a href="{{route('posts.show',$post->id)}}" class="btn btn-secondary">Просмотр</a>
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Редактировать</a>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                    
</form>
</td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading">Данные отсутсвуют =(</h4>
  <p>Данные в таблице отсутвуют, вы можете создать новую запись, нажав на кнопку "Добавить"</p>
</div>
  @endif


    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
