<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = InventoryItem::all();
    	return view('inventories.all_inventoryitems',compact('items'));
    }

    // Show form for creating a new loan
    public function create()
    {
        // return view('loans.create', compact('inventoryItems'));
    }


    /**

     * Store a newly created resource in storage.
     */
    public function store(Request $request){
    	$request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:inventory_items,code',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:available,unavailable',
        ]);
        try{
            $data=new InventoryItem();
            $data->name= $request->name;
            $data->code=$request->code;
            $data->description = $request->description;
            $data->quantity = $request->quantity;
            $data->status = $request->status;

            $data->save();
            return redirect()->route('all.inventoryitem')->with('success', 'Data berhasil disimpan.');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal disimpan! Silakan coba lagi.');
            // return redirect()->route('all.inventoryItem')->with('error', 'Data gagal disimpan! Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('inventories.edit_inventoryitem', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
    $request->validate([
        'code' => 'required|string|max:255|unique:inventory_items,code,' . $id,
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'quantity' => 'required|integer|min:1',
        'status' => 'required|in:available,unavailable',
    ]);
        try{
            $item = InventoryItem::findOrFail($id);
            $item->code = $request->code;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->quantity = $request->quantity;
            $item->status = $request->status;
            $item->save();

            return redirect()->route('all.inventoryitem')->with('success', 'Data berhasil diperbarui.');
        }catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Data gagal disimpan! Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Cari data berdasarkan ID
            $item = InventoryItem::findOrFail($id);
    
            // Hapus datas
            $item->delete();
    
            // Redirect dengan pesan sukses
            return redirect()->route('all.inventoryitem')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('all.inventoryitem')->with('error', 'Data gagal dihapus! Silakan coba lagi.');
        }
    }
    
}
