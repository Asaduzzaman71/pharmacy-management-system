<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesitem extends Model
{

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
