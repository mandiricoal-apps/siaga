<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'departemen',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'role' => 'catering',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'role' => 'hrd',
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'role' => 'ga',
        ]);

        DB::table('users')->insert([
            'nik' => '01234567891011',
            'name' => 'ga',
            'email' => 'ga@example.com',
            'level' => 'ga',
            'departemen' => 'ga',
            'perusahaan' => 'PT. Mandiri Inti Perkasa',
            'divisi' => 'ga',
            'password' => '$2y$10$9yqYVuy.GDmrobZwegfbz.yHL2unoDQzVRUiraJ3kS.ZLasGuOU2K', //string asli = password
            'no_telp' => '081234567890'
        ]);
    }
}
