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
                <div class="card-header">Редактирование сотрудника: <b>{{$user->id.' - '.$user->name}}</b></div>
               

                <div class="card-body">
                <form method="post" action="{{route('users.update',$user->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
    <label>Имя</label>
    <input type="text" class="form-control" placeholder="Введите имя" value="{{ $user->name }}" name="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите email" value="{{ $user->email }}" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль" name="password">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword2">Повторите пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторите пароль" name="password_confirmation">
  </div>

  <button type="submit" class="btn btn-success">Редактировать</button>
  <a href="{{route('users.index')}}" class="btn btn-primary">Назад</a>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
