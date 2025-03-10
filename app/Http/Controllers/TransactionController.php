<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
        ->with(['fromAccount', 'toAccount'])
        ->get();

    return response()->json([
        'transactions' => $transactions,
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
    public function store(StoreTransactionRequest $request)
    {
        $user = Auth::user();
        $fromAccount = BankAccount::where('user_id',$user->id)->findOrFail($request->from_account);
        $toAccount = BankAccount::where('user_id',$user->id)->findOrFail($request->to_account);

        if($fromAccount->money_amount < $request->amount){
            return response()->json([
                'message' => 'You don\'t have enough money'], 400);
        }

                // Выполнение перевода в транзакции
                DB::transaction(function () use ($fromAccount, $toAccount, $request) {
                    // Списание средств с отправителя
                    $fromAccount->decrement('money_amount', $request->amount);
        
                    // Зачисление средств получателю
                    $toAccount->increment('money_amount', $request->amount);
        
                    // Создание записи о переводе
                    Transaction::create([
                        'user_id' => Auth::id(),
                        'from_account' => $request->from_account,
                        'to_account' => $request->to_account,
                        'amount' => $request->amount,
                        'comment' => $request->comment,
                    ]);
                });
        
                return response()->json([
                    'message' => 'Transaction completed',
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
    public function update(StoreTransactionRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
