<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyBudget extends Model
{
    /** @use HasFactory<\Database\Factories\MonthlyBudgetFactory> */
    use HasFactory, HasUlids;
    protected $guarded = [];

    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
