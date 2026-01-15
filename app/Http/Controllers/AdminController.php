<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'open' => Ticket::where('status', 'open')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
            'total' => Ticket::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
