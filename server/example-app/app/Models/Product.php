<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Purchase;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'quantity',
        'expire_date',
       
        'category',
        'brand',

    ];
    protected $guarded = [];

    public function categoryData(){
        return $this->belongsTo(Category::class, 'category', 'id');
    } 

    public function brandData(){
        return $this->belongsTo(Brand::class, 'brand', 'id');
    } 

    public function purchase(){
        return $this->hasMany(Purchase::class, 'product_id', 'id');
    } 


}
