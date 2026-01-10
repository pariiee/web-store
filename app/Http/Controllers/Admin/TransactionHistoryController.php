<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'items.item'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.transactions.index', compact('transactions'));
    }
}
