<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert(
            [
                'user_id' => 1,
                'client_id' => '6779ef20e75817b79601',
                'client_secret' => '3e0f85f44b9ffbc87e90acf40d482601',
                'client_name' => 'Employees Client',
                'redirect_uri' => 'http://127.0.0.1:8081/callback',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
