<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        $logs = ActivityLog::with('user')->latest()->get();
        
        return view('admin.activity_logs.index', compact('logs'));
    }
}