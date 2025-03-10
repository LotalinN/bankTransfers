<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::all();

        return response()->json([
            'banks' => $banks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:banks',
        ]);

        $bank = Bank::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return response()->json([
            'message' => 'Bank created successfully',
            'bank' => $bank,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bank = Bank::findOrFail($id);

        return response()->json([
            'bank' => $bank,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|unique:banks,code,' . $id,
        ]);

        $bank = Bank::findOrFail($id);
        $bank->update($request->only(['name', 'code']));

        return response()->json([
            'message' => 'Bank updated successfully',
            'bank' => $bank,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete();

        return response()->json([
            'message' => 'Bank deleted successfully',
        ]);
    }
}
