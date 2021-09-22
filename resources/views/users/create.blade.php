@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создание сотрудника</div>
               

                <div class="card-body">
                <form method="post" action="{{route('users.store')}}">
                    @csrf
                    <div class="form-group">
    <label>Имя</label>
    <input type="text" class="form-control" placeholder="Введите имя" value="{{ old('email') }}" name="name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите email" value="{{ old('email') }}" name="email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль" name="password">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword2">Повторите пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторите пароль" name="password_confirmation">
  </div>

  <button type="submit" class="btn btn-success">Добавить</button>
  <a href="{{route('users.index')}}" class="btn btn-primary">Назад</a>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
