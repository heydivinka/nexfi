<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class DashboardController extends Controller
{
    
public function index()
{
    $totalMessages = Message::count();
    $todayMessages = Message::whereDate('created_at', today())->count();

    return view('admin.dashboard', compact('totalMessages', 'todayMessages'));
}
}