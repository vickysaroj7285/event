<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $encryptionKey = env('AES_ENCRYPTION_KEY');
        $name = "Charle's Babbage";
        DB::table('users')->insert([
            'name' => DB::raw("AES_ENCRYPT('{$name}','{$encryptionKey}')"),
            'email' => 'babbsage@example.com',
            'password' => bcrypt('password')
        ]);
    }

    //
}
