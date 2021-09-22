<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected static $data = [
        ['category_name'=>'Тестовая категория №1'],
        ['category_name'=>'Тестовая категория №2'],
        ['category_name'=>'Тестовая категория №3'],
        ['category_name'=>'Тестовая категория №4'],
        ['category_name'=>'Тестовая категория №5'],
        ['category_name'=>'Тестовая категория №6'],
        ['category_name'=>'Тестовая категория №7'],
        ['category_name'=>'Тестовая категория №8'],
        ];


    public function run()
    {
        DB::table('categories')->insert(self::$data);
    }
}
