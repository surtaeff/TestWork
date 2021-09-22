@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Сотрудники</div>
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
                <a href="{{route('users.create')}}" class="btn btn-success right">Добавить</a>
                <br><br>
                @if($users->count())
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Email</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($users as $user)
  <tr>
      <td scope="row">{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
      <form action="{{ route('users.destroy',$user->id) }}" method="POST">
      <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Редактировать</a>
      @csrf
@method('DELETE')
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


    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
