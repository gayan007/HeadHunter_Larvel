<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'currency_name',
        'currency_code',
        'user_id',
    ];

    // Define the relationship with the vacancies
    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    // Define any other relationships, scopes, or methods as needed
}