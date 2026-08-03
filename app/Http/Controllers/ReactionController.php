<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Exceptions\ApiException;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use App\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class ReactionController extends Controller
{

    protected string $modelClass = Reaction::class;
    public function getReactions()
    {
        return $this->getAll();
    }

    public function getReactionsByPost(int $id)
    {
        $item = ($this->modelClass)::where('reactable_id', $id)->firstOrFail();
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        return response()->json([$item], 200);
    }

    public function  getReactionsCount() {
        $item = ($this->modelClass)::all()->count();
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        return response()->json($item, 200);
    }

    public function addReaction(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->createRules = [
            'user_id' => 'required|integer',
            'reactable_id' => 'required|integer',
            'reactable_type' => ['required', Rule::in(ReactableType::values())],
            'type' => ['required', Rule::in(ReactionType::values())],
        ];
        return $this->react($request);
    }

    public function deleteReaction(int $id) {
        return $this->delete($id);
    }

    public function counts(){
        $counts = [User::class, View::class, Comment::class, Reaction::class];
        foreach ($counts as $count) {
            if (!($count)::all()->count()) {
                throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
            }
        }
        $users = User::all()->count();
        $views = View::all()->count();
        $reactions = Reaction::all()->count();
        $comments = Comment::all()->count();

        return response()->json([['name' => 'users', 'number' => $users], ['name' => 'views', 'number' => $views], ['name' => 'reactions', 'number' => $reactions], ['name' => 'comments', 'number' => $comments]], 200);
    }
}
