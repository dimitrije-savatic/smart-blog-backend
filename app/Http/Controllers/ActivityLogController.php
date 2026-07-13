<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    public function logs()
    {
        return ActivityLog::select('description', 'created_at', 'action')->orderBy('created_at', 'DESC')->get();
    }
}
