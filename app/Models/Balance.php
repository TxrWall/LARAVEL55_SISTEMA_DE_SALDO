<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array
    {
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        $history = auth()->user()->history()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if ($deposit && $history) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        } else {

            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Falha ao recarregar'
            ];

        }
    }

    public function withdraw(float $value) : Array
    {
        if ($this->amount < $value) {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        $history = auth()->user()->history()->create([
            'type' => 'O',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
        ]);

        if ($withdraw && $history) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao sacar'
            ];
        } else {

            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Falha ao sacar'
            ];

        }
    }

    public function transfer(float $value, User $account) : Array
    {
        if ($this->amount < $value) {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente'
            ];
        }

        DB::beginTransaction();


        /***********************************************************************
         * Update a logged in user balance
         ***********************************************************************/
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $transfer = $this->save();

        $history = auth()->user()->history()->create([
            'type' => 'T',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $account->id
        ]);

        /***********************************************************************
         * Update the balance for the one being credited
         ***********************************************************************/
        $accountUser = $account->balance()->firstOrCreate([]);
        $totalBeforeAccount = $accountUser->amount ? $accountUser->amount : 0;
        $accountUser->amount += number_format($value, 2, '.', '');
        $transferAccount = $accountUser->save();

        $historyAccount = $account->history()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBeforeAccount,
            'total_after' => $accountUser->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => Auth()->user()->id
        ]);

        if ($transfer && $history && $transferAccount && $historyAccount) {

            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao transferir'
            ];
        }

        DB::rollBack();

        return [
            'success' => false,
            'message' => 'Falha ao transferir'
        ];

    }
}
