<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create(['name' => 'Other', 'alias' => '']);
        Major::create(['name' => 'Pendidikan Bahasa Mandarin', 'alias' => 'PBM']);
        Major::create(['name' => 'Akuntansi', 'alias' => 'AK']);
        Major::create(['name' => 'Manajemen', 'alias' => 'MNG']);
        Major::create(['name' => 'Seni Musik', 'alias' => 'SM']);
        Major::create(['name' => 'Seni Tari', 'alias' => 'ST']);
        Major::create(['name' => 'Teknik Industri', 'alias' => 'TI']);
        Major::create(['name' => 'Teknik Lingkungan', 'alias' => 'TL']);
        Major::create(['name' => 'Sistem Informasi', 'alias' => 'SI']);
        Major::create(['name' => 'Teknik Informatika', 'alias' => 'TI']);
        Major::create(['name' => 'Teknik Perangkat Lunak', 'alias' => 'TPL']);
    }
}
