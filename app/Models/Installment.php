<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', 'downpayment', 'paid', 'terms', 'status', 'balance', 'collection_id', 'recievable_id', 'monthly_due', 'interest', 'paid_amount'
    ];
}
