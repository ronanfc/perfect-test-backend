<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    const APROVADO = 1;
    const CANCELADO = 2;
    const DEVOLVIDO = 3;
    const STATUS = [
        self::APROVADO => 'Aprovado',
        self::CANCELADO => 'Cancelado',
        self::DEVOLVIDO => 'Devolvido'
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
        return $this->belongsTo(Client::class);
    }


}
