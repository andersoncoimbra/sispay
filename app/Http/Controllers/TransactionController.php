<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\User;

class TransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        $player = User::find($request->player);
        $payee = User::find($request->payee);
        $value = str_replace('.', '', $request->value);
        $value = str_replace(',', '.', $value);
        $value = (float)$value;

        $transaction = new Transaction();
        $transaction->user_id = $player->id;
        $transaction->account_id = $payee->id;
        $transaction->description = 'Transferência para ' . $payee->name;
        $transaction->value = $value * -1;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->user_id = $payee->id;
        $transaction->account_id = $player->id;
        $transaction->description = 'Transferência de ' . $player->name;
        $transaction->value = $value;
        $transaction->save();

        return response()->json(['success' => true]);
    }
}
