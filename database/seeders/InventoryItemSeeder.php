<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventoryItem;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
        
    //     // InventoryItem::create([
    //     //     'name' => '',
    //     //     'code' => '',
    //     //     'description' => '',
    //     //     'quantity' => '',
    //     //     'status' => '',
            
    //     // ]);
    // }
    public function run()
    {
        $items = [
            [
                'name' => 'green screen',
                'code' => 'ALAT-0081',
                'description' => 'ini green screen',
                'quantity' => 2,
                'status' => 'available',
            ],
            [
                'name' => 'kursi',
                'code' => 'ALAT-0082',
                'description' => 'ini kursi',
                'quantity' => 4,
                'status' => 'available',
            ],
            [
                'name' => 'rocket launcher',
                'code' => 'ALAT-0083',
                'description' => 'ini rocket launcher',
                'quantity' => 2,
                'status' => 'available',
            ],
            [
                'name' => 'thermite',
                'code' => 'ALAT-0084',
                'description' => 'ini petasan',
                'quantity' => 12,
                'status' => 'available',
            ],
        ];

        foreach ($items as $item) {
            InventoryItem::create($item);
        }
    }
}
