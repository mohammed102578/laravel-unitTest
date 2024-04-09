<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Company::factory()->count(100)->create();
        Employee::factory()->count(100)->create();

        $this->call([
            UserSeeder::class,
        ]);  
    
    }
}
