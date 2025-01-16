<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\InventoryItem;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_type',
        'borrower_name',
        'borrower_identity_number',
        'borrower_contact',
        'inventory_item_id',
        'quantity',
        'borrow_date',
        'return_date',
        'status',
    ];

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        // static::updating(function ($loan) {
        //     // Ambil status lama dan baru
        //     $originalStatus = $loan->getOriginal('status');
        //     $newStatus = $loan->approval_status;

        //     // Ambil item inventaris terkait
        //     $item = InventoryItem::findOrFail($loan->inventory_item_id);

        //     // Atur stok berdasarkan perubahan status
        //     if ($originalStatus === 'pending' && $newStatus === 'approved') {
        //         // Jika status berubah dari pending ke approved
        //         $item->quantity -= $loan->quantity;
        //     } elseif ($originalStatus === 'approved' && $newStatus === 'returned') {
        //         // Jika status berubah dari approved ke returned
        //         $item->quantity += $loan->quantity;
        //     } elseif ($originalStatus === 'approved' && $newStatus === 'rejected') {
        //         // Jika status berubah dari approved ke rejected (tidak ada perubahan stok)
        //         $item->quantity += $loan->quantity;
        //     }

        //     $item->save();
        // });

        static::deleting(function ($loan) {
            // Kembalikan stok saat data loan dihapus
            $item = InventoryItem::findOrFail($loan->inventory_item_id);
            if ($loan->status === 'approved') {
                $item->quantity += $loan->quantity;
            }
            $item->save();
        });
    }
}
