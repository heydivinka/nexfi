<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KebijakanController extends Controller
{
    public function index()
    {
        $lastUpdated = '1 Juli 2025';
        $appName     = 'NexFi';
        $appEmail    = 'privacy@nexfi.id';
        $appUrl      = 'https://nexfi.id';

        return view('kebijakan.index', compact('lastUpdated', 'appName', 'appEmail', 'appUrl'));
    }
}