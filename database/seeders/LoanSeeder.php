<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $loans = [
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Bell',
                'borrower_identity_number' => 'A123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 2, // kursi
                'quantity' => 1,
                'status' => 'returned',
                'borrow_date' => '2025-01-10',
                'return_date' => '2025-01-15',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Lion',
                'borrower_identity_number' => 'L123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 3, // rocket launcher
                'quantity' => 1,
                'status' => 'approved',
                'borrow_date' => '2025-01-15',
                'return_date' => '2025-01-18',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Hermes',
                'borrower_identity_number' => 'HR123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 4, // thermite
                'quantity' => 2,
                'status' => 'pending',
                'borrow_date' => '2025-01-16',
                'return_date' => '2025-01-18',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Hephaistos',
                'borrower_identity_number' => 'HP123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 5, // sandal
                'quantity' => 2,
                'status' => 'returned',
                'borrow_date' => '2025-01-16',
                'return_date' => '2025-01-25',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'artemis',
                'borrower_identity_number' => 'AT123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 3, // rocket launcher
                'quantity' => 3,
                'status' => 'returned',
                'borrow_date' => '2025-01-16',
                'return_date' => '2025-01-23',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'lili',
                'borrower_identity_number' => 'LI123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 3, // rocket launcher
                'quantity' => 1,
                'status' => 'approved',
                'borrow_date' => '2025-01-17',
                'return_date' => '2025-01-24',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Ganesha',
                'borrower_identity_number' => 'G123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 6, // spuit
                'quantity' => 4,
                'status' => 'returned',
                'borrow_date' => '2025-01-17',
                'return_date' => '2025-01-18',
            ],
            [
                'borrower_type' => 'student',
                'borrower_name' => 'Syr',
                'borrower_identity_number' => 'SY123456',
                'borrower_contact' => '08123456',
                'inventory_item_id' => 2, // kursi
                'quantity' => 1,
                'status' => 'pending',
                'borrow_date' => '2025-01-17',
                'return_date' => '2025-01-19',
            ],
        ];

        foreach ($loans as $loan) {
            Loan::create($loan);
        }
    }
}
