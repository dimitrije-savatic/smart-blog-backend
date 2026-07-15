<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Reaction;

class PostService
{
    public function __construct(
        private CommentService $commentService
    ) {}

    public function getPostDetails(int $id): array
    {
        $post = Post::with('author')->with('categories')
            ->findOrFail($id);

        return [
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,

            'author' => [
                'id' => $post->author->id,
                'username' => $post->author->username,
            ],
            'categories' => $post->categories,
            'reaction_counts' =>
                $this->getPostReactionCounts($post->id),

            'comments' =>
                $this->commentService->getCommentTreeWithReactions($post->id),
        ];
    }

    private function getPostReactionCounts(int $postId): array
    {
        return Reaction::where('reactable_type', Post::class)
            ->where('reactable_id', $postId)
            ->selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();
    }
}
