<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->enum('borrower_type', ['staff', 'student']);
            $table->string('borrower_name');
            $table->string('borrower_identity_number');;
            $table->string('borrower_contact');
            $table->foreignId('inventory_item_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->date('borrow_date');
            $table->date('return_date');
            $table->enum('status', ['pending', 'approved', 'rejected', 'returned'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
