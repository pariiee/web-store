<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    
    public function index()
    {
        $logs = TransactionLog::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('guest.transaction_history', compact('logs'));
    }

    
    public function show(TransactionLog $log)
    {
        
        if ($log->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('guest.transaction_detail', compact('log'));
    }
}
