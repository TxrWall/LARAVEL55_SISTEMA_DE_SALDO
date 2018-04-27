<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            'id' => 'I',
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
            'id' => 'O',
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
}
