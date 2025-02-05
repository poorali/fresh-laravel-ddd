<?php

namespace Database\Seeders;
use Database\Seeders\AI\AiDriverSeeder;
use Database\Seeders\Shared\ConfigSeeder;
use Database\Seeders\Shared\CountrySeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ConfigSeeder::class);
        $this->call(AiDriverSeeder::class);
    }
}
