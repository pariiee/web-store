<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TransferTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transferLimitInfo = $user->getTransferLimitInfo();
        
        return view('guest.transfer-saldo.index', compact('user', 'transferLimitInfo'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');
        
        if (empty($search) || strlen($search) < 2) {
            return response()->json([]);
        }

        $users = User::where('id', '!=', Auth::id())
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('whatsapp', 'like', "%{$search}%")
                    ->orWhere('nama_tele', 'like', "%{$search}%");
            })
            ->whereNull('deleted_at')
            ->limit(10)
            ->get()
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->nama_tele,
                    'email' => $user->email,
                    'whatsapp' => $user->whatsapp,
                    'profile_photo' => $user->profile_photo ? asset('storage/profile/' . $user->profile_photo) : asset('images/default_pp.jpg')
                ];
            });

        return response()->json($users);
    }

    public function show($id)
    {
        $receiver = User::where('id', $id)
            ->whereNull('deleted_at')
            ->firstOrFail();

        $user = Auth::user();
        $transferLimitInfo = $user->getTransferLimitInfo();

        return view('guest.transfer-saldo.confirm', compact('user', 'receiver', 'transferLimitInfo'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:100',
            'note' => 'nullable|string|max:255'
        ]);

        $user = Auth::user();
        $receiver = User::findOrFail($request->receiver_id);
        $amount = $request->amount;

        // Validasi receiver
        if ($receiver->id === $user->id) {
            return back()->with('error', 'Tidak bisa transfer ke diri sendiri');
        }

        if ($receiver->deleted_at) {
            return back()->with('error', 'Akun penerima tidak tersedia');
        }

        try {
            $transfer = $user->transferSaldo($receiver, $amount, $request->note);
            
            return redirect()->route('transfer.history')
                ->with('success', 'Transfer berhasil! Saldo telah dikirim ke ' . $receiver->name);
                
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function history()
    {
        $user = Auth::user();
        
        $transfers = TransferTransaction::with(['sender', 'receiver'])
            ->where(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('guest.transfer-saldo.history', compact('user', 'transfers'));
    }
}