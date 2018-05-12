<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
use App\Models\History;

class BalanceController extends Controller
{
    private $totalItensPerPage = 5;

    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;


        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);
        }

        return redirect()
            ->back()
            ->with('error', $response['message']);
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->first();
        $response = $balance->withdraw($request->value);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);
        }

        return redirect()
            ->back()
            ->with('error', $response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user)
    {
        if (!$account = $user->getAccount($request->account)) {

            return redirect()
                ->back()
                ->with('error', 'Contemplado inexistente.');

        }

        if ($account->id == auth()->user()->id) {

            return redirect()
                ->back()
                ->with('error', 'Não é possível tranferir valores para sua prórpia conta.');

        }

        $balance = Auth()->user()->balance;

        return view('admin.balance.transfer-confirm', compact('account', 'balance'));
    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {
        if (!$account = $user->find($request->account_id)) {
            return redirect()
                ->route('balance.transfer')
                ->with('success', 'Contemplado não encontrado');
        }

        $balance = auth()->user()->balance()->first();
        $response = $balance->transfer($request->value, $account);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->with('success', $response['message']);
        }

        return redirect()
            ->route('balance.transfer')
            ->with('error', $response['message']);
    }

    public function history(History $history)
    {
        $histories = Auth()->user()
            ->history()
            ->with(['userAccount'])
            ->paginate($this->totalItensPerPage);

        $types = $history->type();

        return view('admin.balance.history', compact('histories', 'types'));
    }

    public function searchHistories(Request $request, History $history)
    {
        $formData = $request->except('_token');

        $histories = $history->search($formData, $this->totalItensPerPage);

        $types = $history->type();

        return view('admin.balance.history', compact('histories', 'types', 'formData'));
    }
}
