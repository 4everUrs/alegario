<?php

namespace App\Models;

use App\Models\disbursement\DisburseRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'department', 'requestor', 'description', 'amount', 'status', 'file_name', 'date_approved', 'remarks', 'original_file_name'
    ];
    // public function DisburseRequest()
    // {
    //     return $this->belongsTo(DisburseRequest::class);
    // }
}
