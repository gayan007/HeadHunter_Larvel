<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class VacancyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test adding a vacancy.
     *
     * @return void
     */
    public function testAddVacancy()
    {
        // Create a mock request with valid data
        $data = [
            'header' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'salary_min' => 50000,
            'salary_max' => 80000,
            'client_id' => \App\Models\Client::factory()->create()->id,
            'available_positions' => 3,
        ];

        $response = $this->postJson('/api/vacancies', $data);

        // Assert response status code is 201 (Created)
        $response->assertStatus(201);

        // Assert response contains expected message
        $response->assertExactJson(['message' => 'Vacancy added successfully']);

        // Assert the vacancy was created in the database
        $this->assertDatabaseHas('vacancies', [
            'header' => $data['header'],
            'description' => $data['description'],
            'salary_min' => $data['salary_min'],
            'salary_max' => $data['salary_max'],
            'client_id' => $data['client_id'],
            'available_positions' => $data['available_positions'],
        ]);
    }
}
