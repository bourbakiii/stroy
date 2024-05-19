<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workers')->insert([
            [
            'name' => 'Мозлов Имран Асламович',
            'type_id' => '1',
            'age' => '21',
            'gender' => '1',
            ],
            [
            'name' => 'Хадзарагов Савва Аркадиевич',
            'type_id' => '2',
            'age' => '16',
            'gender' => '1',
            ],
            [
                'name' => 'Белик Антон Сергеевич',
                'type_id' => '3',
                'age' => '20',
                'gender' => '1',
            ],
        ]);
    }
}
