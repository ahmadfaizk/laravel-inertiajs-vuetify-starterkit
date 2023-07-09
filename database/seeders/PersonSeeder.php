<?php

namespace Database\Seeders;

use Database\Factories\PersonFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonFactory::new()->count(100)->create();
    }
}
