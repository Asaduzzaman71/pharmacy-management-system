<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'medicines' , 'medicine_code' , 'medicine_category_id', 'purchase_price','selling_price', 'storing_area','quantity',
        'generic_name','medicine_clas','effects','expire_date'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'medicine_category_id');
    }

    public function salesitems()
    {
       return $this->hasMany(Salesitem::class);

    }


}
