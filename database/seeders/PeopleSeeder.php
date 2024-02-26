<?php

namespace Database\Seeders;

use Database\Factories\PeopleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeopleFactory::new()->count(100)->create();
    }
}
