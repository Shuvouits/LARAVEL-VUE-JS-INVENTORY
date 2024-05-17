<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpenseCategory;

class Expense extends Model
{
    use HasFactory;

    public function expenseCategoryData(){
        return $this->belongsTo(ExpenseCategory::class, 'expense_id', 'id');
    } 


}
