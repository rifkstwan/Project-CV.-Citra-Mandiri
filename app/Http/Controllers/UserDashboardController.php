<?php

namespace App\Http\Controllers;

use App\Models\Pakets;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserDashboardController extends Controller implements HasMiddleware
{
    /**
     * Middleware untuk akses user
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:user-access', only: ['index']),
        ];
    }

    /**
     * Display user dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Jika admin, redirect ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.index');
        }

        // Ambil paket aktif user (yang sudah diaktivasi)
        $activeOrders = Orders::with('paket')
            ->where('user_id', $user->id)
            ->where('is_activated', 'yes')
            ->latest()
            ->get();

        // Return ke view user.dashboard
        return view('user.dashboard', compact('activeOrders'));
    }
}
