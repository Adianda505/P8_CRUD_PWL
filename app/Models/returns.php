<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class returns extends Model
{
    protected $fillable = [
        'loan_detail_id',
        'charge',
        'amount',
    ];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class);
    }
}
