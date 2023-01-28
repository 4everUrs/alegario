<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = [
        'reciepient', 'address', 'phone', 'practitioner_id', 'installment_id', 'payment_method', 'amount',
        'discount', 'status'
    ];
    public function Practitioner()
    {
        return $this->belongsTo(Practitioner::class);
    }
}
