<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    protected string $modelClass = User::class;

    public function users()
    {
        return User::all();
    }

    public function getUsersCount()
    {
        $item = ($this->modelClass)::all()->count();
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        return response()->json($item, 200);
    }

    public function user(int $id)
    {
        return User::find($id);
    }
}
