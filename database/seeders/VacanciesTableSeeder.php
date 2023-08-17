<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientIDs= DB::table('clients')->pluck('id');
        // Define an array of sample vacancy data
        $vacancies = [
            [
                'header' => 'Web Developer',
                'description' => 'Looking for an experienced web developer...',
                'salary_min' => 50000.00,
                'salary_max' => 80000.00,
                'client_id' => $clientIDs->random(),
                'available_positions' => 2,
            ],
            [
                'header' => 'UI/UX Designer',
                'description' => 'Seeking a creative UI/UX designer with a passion...',
                'salary_min' => 45000.00,
                'salary_max' => 70000.00,
                'client_id' => $clientIDs->random(),
                'available_positions' => 1,
            ],
            [
                'header' => 'Marketing Manager',
                'description' => 'Join our dynamic marketing team and drive growth...',
                'salary_min' => 60000.00,
                'salary_max' => 90000.00,
                'client_id' => $clientIDs->random(),
                'available_positions' => 1,
            ],
            [
                'header' => 'Software Engineer',
                'description' => 'We are hiring software engineers to build innovative solutions...',
                'salary_min' => 55000.00,
                'salary_max' => 85000.00,
                'client_id' => $clientIDs->random(),
                'available_positions' => 3,
            ],
        ];

        // Insert the data into the vacancies table
        DB::table('vacancies')->insert($vacancies);
    }
}
