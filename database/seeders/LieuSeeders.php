<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lieu;

class LieuSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lieu::factory(10)->create();
    }
}
