<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankAccountRequest;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankAccounts = BankAccount::where('user_id', Auth::id())->get();

        return response()->json([
            'bank_accounts' => $bankAccounts,
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
    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create([
            'user_id' => Auth::id(),
            'bank_id' => $request->bank_id,
            'account_number' => $request->account_number,
            'money_amount' => 0.00,
        ]);

        return response()->json([
            'message' => 'Bank account created succesfully',
            'bank_account' => $bankAccount,
        ], 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
  /*  public function update(Request $request, string $id)
    {
        //
    }
    /*
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bankAccount = BankAccount::where('user_id', Auth::id())->findOrFail($id);

        $bankAccount->delete();
    
        return response()->json([
            'message' => 'Bank account deleted successfully',
        ]);
    }

}
