<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_id', 'particular', 'quantity', 'cost', 'total_cost'
    ];
    public function Collections()
    {
        return $this->belongsTo(Collection::class);
    }
}
