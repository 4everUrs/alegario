<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $fillable = [
        'year', 'amount', 'encoded_by', 'general', 'maintenance', 'operating', 'improvisation'
    ];
}
