<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'descricao',
        'preco'
    ];
    public function sales() {
        return $this->hasMany(Sale::class);
    }
}
