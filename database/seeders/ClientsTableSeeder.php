<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        // Define an array of sample client data
        $clients = [
            [
                'name' => 'Client A',
                'country' => 'USA',
                'currency_name' => 'US Dollar',
                'currency_code' => 'usd',
                'user_id' => 1, // Replace with appropriate user_id
            ],
            [
                'name' => 'Client B',
                'country' => 'UK',
                'currency_name' => 'British Pound',
                'currency_code' => 'gbp',
                'user_id' => 1, // Replace with appropriate user_id
            ],
            [
                'name' => 'Client C',
                'country' => 'Germany',
                'currency_name' => 'Euro',
                'currency_code' => 'eur',
                'user_id' => 1, // Replace with appropriate user_id
            ],
            [
                'name' => 'Client D',
                'country' => 'Japan',
                'currency_name' => 'Japanese Yen',
                'currency_code' => 'jpy',
                'user_id' => 1, // Replace with appropriate user_id
            ],
        ];

        // Insert the data into the clients table
        DB::table('clients')->insert($clients);
    }
}
