<?php

namespace App\Http\Controllers;

use App\Services\TransactionsService;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    protected TransactionsService $transactionsService;

    public function __construct(TransactionsService $transactionsService)
    {
        $this->transactionsService = $transactionsService;
    }

    public function index()
    {
        $transactions = $this->transactionsService->getAllTransactions();
        return view('panels.transactions.index', compact('transactions'));
    }

    public function showCreateForm()
    {
        $transactionTypes = $this->transactionsService->getAllTransactionTypes();

        return view('panels.transactions.create', compact('transactionTypes'));
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'amount' => 'required|numeric',
                'description' => 'required|string',
                'type_id' => 'required|integer',
            ]
        );

        $this->transactionsService->createTransaction($data);

        return redirect()->route('transactions.index')->with(
            'success',
            'Transaction registrada satisfactoriamente'
        );
    }

    public function detail($id)
    {
        $transaction = $this->transactionsService->getTransactions($id);
        return view('panels.transactions.detail', compact('transaction'));
    }


}
