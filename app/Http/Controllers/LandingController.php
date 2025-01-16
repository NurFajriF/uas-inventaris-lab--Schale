<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\Loan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    //
    public function index()
    {
        $inventoryItems = InventoryItem::where('status', 'available')->get();
        // return view('loans.create', compact('inventoryItems'));
        return view('landing', compact('inventoryItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'borrower_type' => 'required|in:student,staff',
            'borrower_name' => 'required|string|max:255',
            'borrower_identity_number' => 'required|string|max:50',
            'borrower_contact' => 'required|string|max:255',
            'inventory_item_id' => 'required|exists:inventory_items,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
        ]);

        try{
            $loan = new Loan();
            $loan->borrower_type=$request->borrower_type;
            $loan->borrower_name=$request->borrower_name;
            $loan->borrower_identity_number=$request->borrower_identity_number;
            $loan->borrower_contact=$request->borrower_contact;
            $loan->inventory_item_id=$request->inventory_item_id;
            $loan->quantity=$request->quantity;
            $loan->borrow_date=$request->borrow_date;
            $loan->return_date=$request->return_date;
            $loan->status = 'pending'; // Default status
            $loan->save();

            // if (Auth::check()) {
            //     return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil disimpan.');
            // } else {
            //     return redirect()->route('/')->with('success', 'Data peminjaman berhasil disimpan.');
            // }
            return redirect()->route('landing')->with('success', 'Data peminjaman berhasil disimpan.');

            // return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil dibuat.');
        }catch(\Exception $e) {
            Log::error('Error saat menyimpan data loan', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Data gagal disimpan! Silakan coba lagi.');
            // return redirect()->route('all.inventoryItem')->with('error', 'Data gagal disimpan! Silakan coba lagi.');
        }
    }
}
