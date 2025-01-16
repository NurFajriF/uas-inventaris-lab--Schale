<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class LoanController extends Controller
{
    // Display all loans
    public function index()
    {
        $loans = Loan::with('inventoryItem')->get();
        // $inventoryItems = InventoryItem:where('id', $loans->'')
        return view('loans.all_loans', compact('loans'));
    }

    // Show form for creating a new loan
    public function create()
    {
        $inventoryItems = InventoryItem::where('status', 'available')->get();
        // return view('loans.create', compact('inventoryItems'));
        return view('loans.add_loan', compact('inventoryItems'));
    }

    // Store a new loan
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

            if (Auth::check()) {
                return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil disimpan. Tunggu persetujuan.');
            } else {
                return redirect()->route('/')->with('success', 'Data peminjaman berhasil disimpan.');
            }

            // return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil dibuat.');
        }catch(\Exception $e) {
            Log::error('Error saat menyimpan data loan', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Data gagal disimpan! Silakan coba lagi.');
            // return redirect()->route('all.inventoryItem')->with('error', 'Data gagal disimpan! Silakan coba lagi.');
        }
    }

    // Show a specific loan
    public function show($id)
    {
        // $loan = Loan::with('inventoryItem')->findOrFail($id);
        // return view('loans.show', compact('loan'));
    }

    // Show form for editing a loan
    public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $inventoryItems = InventoryItem::where('status', 'available')->get();
        return view('loans.edit_loan', compact('loan', 'inventoryItems'));
        
    }

    // Update a loan
    public function update(Request $request, $id)
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
            'status' => 'required|in:pending,approved,rejected,returned',
        ]);

        try {
            // Ambil data loan
            $loan = Loan::findOrFail($id);
            $originalStatus = $loan->status;
            $newStatus = $request->status;
    
            // Ambil data item terkait
            $item = InventoryItem::findOrFail($request->inventory_item_id);
    
            // Logika perubahan stok berdasarkan status
            if ($originalStatus === 'pending' && $newStatus === 'approved') {
                // Dari pending ke approved
                $item->quantity -= $request->quantity;
            } elseif ($originalStatus === 'approved' && $newStatus === 'returned') {
                // Dari approved ke returned
                $item->quantity += $loan->quantity;
            } elseif ($originalStatus === 'approved' && $newStatus === 'rejected') {
                // Dari approved ke rejected
                $item->quantity += $loan->quantity;
            } elseif ($originalStatus === 'returned' && $newStatus === 'approved') {
                // Dari returned kembali ke approved
                $item->quantity -= $loan->quantity;
            }
    
            // Pastikan stok tidak negatif
            if ($item->quantity < 0) {
                return redirect()->route('all.loan')->with('error', 'Stok barang tidak mencukupi untuk menyetujui peminjaman.');
            }
    
            // Simpan perubahan stok dan data loan
            $item->save();
            $loan->update([
                'borrower_type' => $request->borrower_type,
                'borrower_name' => $request->borrower_name,
                'borrower_identity_number' => $request->borrower_identity_number,
                'borrower_contact' => $request->borrower_contact,
                'inventory_item_id' => $request->inventory_item_id,
                'quantity' => $request->quantity,
                'borrow_date' => $request->borrow_date,
                'return_date' => $request->return_date,
                'status' => $newStatus,
            ]);
            return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            // Log::error('Error saat mengupdate data loan', ['error' => $e->getMessage()]);
            Log::error("Error saat memperbarui data loan: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Data gagal diperbarui! Silakan coba lagi.');
        }
    }

    public function updateStatus(Request $request, Loan $loan)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,returned',
        ]);

        $loan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('all.loan')->with('success', 'Status peminjaman berhasil diperbarui.');
    }



    // Delete a loan
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('all.loan')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
