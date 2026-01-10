<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TopupTransaction;
use App\Models\RedeemClaim;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all transaction logs for this user
        $logs = TransactionLog::where('user_id', $user->id)
            ->with(['transfer.sender', 'transfer.receiver', 'transaction'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($log) {
                $title = '';
                $description = $log->description;
                
                switch ($log->type) {
                    case TransactionLog::TYPE_PURCHASE:
                        $title = 'Pembelian Item';
                        break;
                    case TransactionLog::TYPE_TOPUP:
                        $title = 'Top Up Saldo';
                        $description = 'Top Up via QRIS';
                        break;
                    case TransactionLog::TYPE_REDEEM:
                        $title = 'Redeem Saldo';
                        $description = 'Kode Redeem';
                        break;
                    case TransactionLog::TYPE_TRANSFER_OUT:
                        $title = 'Transfer Saldo';
                        if ($log->transfer && $log->transfer->receiver) {
                            $description = 'TF ke ' . $log->transfer->receiver->name;
                        }
                        break;
                    case TransactionLog::TYPE_TRANSFER_IN:
                        $title = 'Transfer Masuk';
                        if ($log->transfer && $log->transfer->sender) {
                            $description = 'TF dari ' . $log->transfer->sender->name;
                        }
                        break;
                    default:
                        $title = 'Transaksi';
                }

                return [
                    'type'        => $log->type,
                    'title'       => $title,
                    'description' => $description,
                    'amount'      => $log->amount,
                    'date'        => $log->created_at,
                ];
            });

        // Untuk kompatibilitas dengan view yang lama, kita buat $histories
        $histories = collect($logs)->sortByDesc('date')->values();

        return view('guest.transaction_history', compact('user', 'histories'));
    }
}