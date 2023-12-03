<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //これは認証できた
        Admin::factory()->create([
            'name' => 'sano',
            'login_id' => 'sano_id',
            'password' => Hash::make('1234'),
        ]);

        Admin::factory()->create([
            'name' => 'sato',
            'login_id' => 'sato_id',
            'password' => Hash::make('1234'),
        ]);

        /*
        これは認証できないものからできるものに変わった
        'password' => '1234'を
        'password' => Hash::make('5678'),に変えた
        */
        Admin::factory()->create([
            'name' => 'akira',
            'login_id' => 'akira',
            'password' => Hash::make('5678'),
        ]);

        Admin::factory()->create([
            'name' => 'keiko',
            'login_id' => 'keiko',
            'password' => '12345678',
        ]);

    }
}
