<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\User;
use DB;

class TransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        $this->authorize('tranferencia');
        $this->validate($request, [
            'player' => 'required|exists:users,id',
            'payee'=> 'required|exists:users,id',
            'value' => 'required|min:1',
        ]);


        $player = User::find($request->player);
        $payee = User::find($request->payee);
        $value = str_replace('.', '', $request->value);
        $value = str_replace(',', '.', $value);
        $value = (float)$value;
        if ($player->getBalance() < $value) {
            return response()->json([
                'message' => 'Saldo insuficiente'
            ], 400);
        }
        DB::beginTransaction();

        try{
                $transactionPlayer = new Transaction();
                $transactionPlayer->user_id = $player->id;
                $transactionPlayer->account_id = $payee->id;
                $transactionPlayer->description = 'Transferência para ' . $payee->name;
                $transactionPlayer->value = $value * -1;
                $transactionPlayer->save();

                $transactionPayee = new Transaction();
                $transactionPayee->user_id = $payee->id;
                $transactionPayee->account_id = $player->id;
                $transactionPayee->description = 'Transferência de ' . $player->name;
                $transactionPayee->value = $value;
                $transactionPayee->save();

                if($transactionPayee->id && $transactionPlayer->id){
                    DB::commit();
                    return response()->json([
                        'message' => 'Transferência realizada com sucesso'
                    ], 200);
                }else{
                    DB::rollback();
                    return response()->json([
                        'message' => 'Erro ao realizar a transferência'
                    ], 400);
                }
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'message' => 'Erro ao transferir erro:'. $e->getMessage()
            ], 500);
        }



        return response()->json(['success' => true, 'message' => 'Transferência efetuada com sucesso!']);
    }
}
