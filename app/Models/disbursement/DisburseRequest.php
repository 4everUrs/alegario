<?php

namespace App\Models\disbursement;

use App\Models\BudgetRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisburseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_requests_id', 'status', 'approve_amount'
    ];
    public function BudgetRequests()
    {
        return $this->belongsTo(BudgetRequest::class);
    }
}
