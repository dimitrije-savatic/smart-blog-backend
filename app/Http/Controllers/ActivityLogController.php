<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;

class ActivityLogController extends Controller
{

    public function logs()
    {
        return ActivityLog::select('description', 'created_at', 'action')->orderBy('created_at', 'DESC')->get();
    }
}
