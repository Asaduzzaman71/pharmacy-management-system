<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

	 protected $guarded=[];
     public function expensecategory()
       {
           return $this->belongsTo(Expensecategory::class,'expense_category_id');
       }
}

