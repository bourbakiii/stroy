<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeOfWorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_of_workers')->insert([
            ['name' => 'Каменщик'],
            ['name' => 'Токарь'],
            ['name' => 'Плотник'],
            ['name' => 'Сварщик'],
            ['name' => 'Электрик'],
            ['name' => 'Столяр'],
            ['name' => 'Крановщик'],
            ['name' => 'Штукатур'],
            ['name' => 'Сантехник'],
            ['name' => 'Маляр'],
        ]);
    }
}
