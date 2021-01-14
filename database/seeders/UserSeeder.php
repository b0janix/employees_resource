<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hashed = password_hash('cosmicdev', PASSWORD_BCRYPT);
        DB::table('users')->insert(
            [
                'username' => 'hiring',
                'password' => $hashed,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
