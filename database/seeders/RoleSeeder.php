<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected static $data = [
        ['name'=>'Менеджер','description'=>'Основная роль системы с правами на создание сотрудников'],
        ['name'=>'Сотрудник','description'=>'Роль с урезанными правами, может только создавать редактировать и просматривать собственные записи'],
        ];


    public function run()
    {
        DB::table('roles')->insert(self::$data);
    }
}
