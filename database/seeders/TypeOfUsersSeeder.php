<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_of_users')->insert([
            ['name' => 'Строительное управление'],
            ['name' => 'Заказчик'],
            ['name' => 'Начальник участка'],
        ]);
    }
}
