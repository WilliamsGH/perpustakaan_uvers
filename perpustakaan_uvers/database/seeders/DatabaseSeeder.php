<?php

namespace Database\Seeders;

use App\Models\institution;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Master Data
        $this->call(InstitutionSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(CategorySeeder::class);

        // Super User
        User::create([
            'institution_id' => 1,
            'major_id' => 1,
            'name' => 'Administrator',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'super_admin'
        ]);
    }
}
