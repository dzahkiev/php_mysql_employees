<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{

    public function run()
    {
         DB::table('department')->insert([
            ['name' => 'Отдел закупок'],
            ['name' => 'Отдел продаж'],
            ['name' => 'PR-отдел'],
        ]);
    }
}
