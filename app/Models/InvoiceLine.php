<?php

// app/Models/InvoiceLine.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    protected $fillable = [
        'invoice_id', 'vacancy_id', 'no_of_applications', 'avg_salary', 'commission_usd'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
