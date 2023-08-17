<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'expected_salary',
        'cv_file',
        'vacancy_id',
    ];

    // Define the relationship with the Vacancy model
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    // Define any other relationships, scopes, or methods as needed
}
