<?php

namespace Database\Seeders;

use App\Models\Categor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categor::create(['name' => 'reada']);
    }
}
