<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'encoder',
    ];
    public function Entries()
    {
        return $this->hasMany(Entry::class);
    }
}
