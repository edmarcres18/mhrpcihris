<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItInventory;
use App\Imports\ItInventoryImport;
use Maatwebsite\Excel\Facades\Excel;

class ItInventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:inventory-list|inventory-create|inventory-edit|inventory-delete', ['only' => ['index','show']]);
        $this->middleware('permission:inventory-create', ['only' => ['create','store']]);
        $this->middleware('permission:inventory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = ItInventory::all();
        return view('inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ItInventory::create($request->all());
        return redirect()->route('inventory.index')->with('success', 'Inventory successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItInventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItInventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItInventory $inventory)
    {
        $inventory->update($request->all());
        return redirect()->route('inventory.index')->with('success', 'Inventory successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItInventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new ItInventoryImport, $request->file('file'));

        return redirect()->route('inventory.index')->with('success', 'Inventory data imported successfully');
    }
}