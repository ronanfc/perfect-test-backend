<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    const STATUS = [
        1 => 'Aprovado',
        2 => 'Cancelado',
        3 => 'Devolvido'
    ];

    protected $fillable = [
        'product_id',
        'client_id',
        'date_sale',
        'qtd_product',
        'discount',
        'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function client() {
        return $this->belongsTo(Product::class);
    }


}
