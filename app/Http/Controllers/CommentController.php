<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Exceptions\ApiException;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{

    public function __construct(
        private readonly CommentService $commentService
    ) {
    }

    protected string $modelClass = Comment::class;
    protected array $createRules = [
        'body' => 'required|string|min:3',
        'user_id' => 'required|integer',
        'post_id' => 'required|integer',
        'parent_id' => 'integer|nullable'
    ];
    protected array $updateRules = [
        'body' => 'string|min:3',
    ];

    public function getComments()
    {
        return $this->getAll();
    }

    public function getCommentsByPost($post_id)
    {
        return response()->json($this->commentService->getCommentTreeWithReactions($post_id));
    }

    public function  getCommentsCount() {
        $item = ($this->modelClass)::all()->count();
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        return response()->json($item, 200);
    }

    public function addComment(Request $request)
    {
        return $this->create($request);
    }

    public function updateComment(Request $request, int $id){
        return $this->update($request, $id);
    }

    public function deleteComment(int $id){
        return $this->delete($id);
    }
}
