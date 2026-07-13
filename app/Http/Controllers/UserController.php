<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function users()
    {
        return User::all();
    }

    public function user(int $id)
    {
        return User::find($id);
    }
}
