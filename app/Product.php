<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'img_src'
    ];
    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
