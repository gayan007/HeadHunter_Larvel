<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'description',
        'salary_min',
        'salary_max',
        'client_id',
        'available_positions',
    ];

    // Define the relationship with the Client model
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Define any other relationships, scopes, or methods as needed
}