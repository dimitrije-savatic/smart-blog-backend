<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function logs()
    {
        return Log::orderBy('created_at', 'DESC')->get();
    }
}
