<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'quantity',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->quantity < 0) {
                throw new \Exception('Stok barang tidak boleh negatif.');
            }
        });
    }

    /**
     * Method to adjust stock in InventoryItem.
     */
    // public function adjustStock($quantity, $operation = 'decrease')
    // {
    //     if ($operation === 'decrease') {
    //         if ($this->quantity < $quantity) {
    //             throw new \Exception('Stok tidak mencukupi.');
    //         }
    //         $this->quantity -= $quantity;
    //     } elseif ($operation === 'increase') {
    //         $this->quantity += $quantity;
    //     }

    //     $this->save();
    // }


}
