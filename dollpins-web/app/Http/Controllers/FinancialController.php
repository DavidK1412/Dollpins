<?php

namespace App\Http\Controllers;

use App\Services\TransactionsService;

class FinancialController extends Controller
{
    protected TransactionsService $transactionsService;

    public function __construct(TransactionsService $transactionsService)
    {
        $this->transactionsService = $transactionsService;
    }

    public function index()
    {
        $transactions = $this->transactionsService->all();
        return view('transactions.index', compact('transactions'));
    }

    public function showCreateForm()
    {
        return view('transactions.create');
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

        $this->transactionsService->create($data);

        return redirect()->route('transactions.index');
    }

    public function detail($id)
    {
        $transaction = $this->transactionsService->findById($id);
        return view('transactions.detail', compact('transaction'));
    }


}
