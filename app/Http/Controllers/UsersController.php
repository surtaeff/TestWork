<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Access\Gate;

class UsersController extends Controller
{


        /**
        * Display a listing of the resource.
        *
        * @return Response
        */

        public function index()
        {
            $users = User::where('manager_id',auth()->user()->id)->paginate(2);
            return view('users.index',compact('users'));
        }
    
        /**
            * Show the form for creating a new resource.
            *
            * @return Response
            */
        public function create()
        {
            return view('users.create');
        }
    
        /**
            * Store a newly created resource in storage.
            *
            * @return Response
            */
        public function store(Request $request)
        {
            $request->validate([
                'name'=> 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'name.required' => 'Поле имя обязательно к заполнению',
                'email.required' => 'Вы не ввели email',
                'email.unique' => 'Данный email уже используется',
                'password.required' => 'Вы не ввели пароль',
                'password.min' => 'Длина пароля должна быть не менее 8 символов',
                'password.confirmed' => 'Вы не подтвердили пароль или пароли не совпадают'
            ]);
    
            User::create([
                'name' => $request['name'],
                'role_id' => 2,
                'manager_id' => auth()->user()->id,
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
    
            return redirect()->route('users.index')->with('success','Сотрудник '.$request['name'].' успешно добавлен');
        }
    
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            //
        }
    
        /**
            * Show the form for editing the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function edit($id)
        {
            $user = User::find($id);
            return view('users.edit',compact('user'));
        }
    
        /**
            * Update the specified resource in storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function update($id,Request $request)
        {
            $request->validate([
                'name'=> 'required',
                'email' => 'required|unique:users,email,'.$id,
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'name.required' => 'Поле имя обязательно к заполнению',
                'email.required' => 'Вы не ввели email',
                'email.unique' => 'Данный email уже используется',
                'password.required' => 'Вы не ввели пароль',
                'password.min' => 'Длина пароля должна быть не менее 8 символов',
                'password.confirmed' => 'Вы не подтвердили пароль или пароли не совпадают'
            ]);
    

            User::find($id)->update([
                'name' => $request['name'],
                'role_id' => 2,
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
    
            return redirect()->route('users.index')->with('primary','Сотрудник '.$request['name'].' успешно отредактирован');
        }
    
        /**
            * Remove the specified resource from storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function destroy(User $user)
        {
            $user->delete();
            return redirect()->route('users.index')->with('danger','Сотрудник '.$user->name.' удален');
        }



}
