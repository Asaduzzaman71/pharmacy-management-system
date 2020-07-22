<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expensecategory extends Model
{
    protected $guarded=[];
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
