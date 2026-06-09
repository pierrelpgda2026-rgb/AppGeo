<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::factory(10)->create();
    }
}
