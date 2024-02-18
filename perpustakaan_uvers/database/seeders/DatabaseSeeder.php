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
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'super_admin'
        ]);

        User::create([
            'institution_id' => 1,
            'major_id' => 1,
            'name' => 'Williams',
            'email' => 'williams342002@uvers.ac.id',
            'username' => '2020133002',
            'password' => Hash::make('admin'),
            'role' => 'super_admin'
        ]);
    }
}
