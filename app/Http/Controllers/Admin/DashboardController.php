<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMessages  = Message::count();
        $todayMessages  = Message::whereDate('created_at', today())->count();

        $totalTestimoni = Testimonial::count();
        $todayTestimoni = Testimonial::whereDate('created_at', today())->count();

        return view('admin.dashboard', compact(
            'totalMessages',
            'todayMessages',
            'totalTestimoni',
            'todayTestimoni'
        ));
    }
}