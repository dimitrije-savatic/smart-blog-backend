<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
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

    public function getCommentsByPost($post_id)
    {
        return Comment::select('comments.body', 'users.username')->join('users', 'users.id', '=', 'comments.user_id')->where('post_id', $post_id)->get();
    }

    public function getComments()
    {
        return $this->getAll();
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

    public function reactToComment(Request $request, Comment $comment)
    {
        $this->reactRules = [
            'reactable_type' => ['required', Rule::in(ReactableType::values())],
            'type' => ['required', Rule::in(ReactionType::values())],
        ];

        return $this->react($request, $comment);
    }
}
