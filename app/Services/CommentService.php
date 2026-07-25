<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Reaction;

class CommentService
{
    public function getCommentTreeWithReactions(int $postId): array
    {
        // 1. Load comments (NO reactions)
        $comments = Comment::where('post_id', $postId)
            ->with('user')
            ->get();

        $commentIds = $comments->pluck('id')->toArray();

        // 2. Load ALL reactions in one query
        $reactions = $this->getGroupedReactions($commentIds);

        // 3. Group comments by parent_id
        $grouped = $comments->groupBy('parent_id');

        // 4. Build tree
        return $this->buildTree($grouped, null, $reactions);
    }

    private function buildTree($grouped, $parentId, $reactions): array
    {
        $comments = $grouped[$parentId] ?? collect();

        return $comments->map(function ($comment) use ($grouped, $reactions) {

            return [
                'id' => $comment->id,
                'body' => $comment->body,
                'author' => [
                    'id' => $comment->user->id,
                    'first_name' => $comment->user->first_name,
                    'last_name' => $comment->user->last_name,
                ],
                'reaction_counts' =>
                    $this->formatReactions(
                        $reactions[$comment->id] ?? collect()
                    ),
                'users_reaction' => $this->getUsersReaction($comment->id),
                'replies' =>
                    $this->buildTree($grouped, $comment->id, $reactions),
            ];
        })->values()->toArray();
    }

    private function getGroupedReactions(array $commentIds)
    {
        return Reaction::where('reactable_type', strtolower(class_basename(Comment::class)))
            ->whereIn('reactable_id', $commentIds)
            ->selectRaw('reactable_id, type, COUNT(*) as total')
            ->groupBy('reactable_id', 'type')
            ->get()
            ->groupBy('reactable_id');
    }

    private function formatReactions($reactions): array
    {
        return $reactions
            ->pluck('total', 'type')
            ->toArray();
    }

    private function getUsersReaction(int $commentId): bool
    {
        $usersReaction =  Reaction::where('reactable_type', strtolower(class_basename(Comment::class)))
            ->where('reactable_id', $commentId)
            ->where('user_id', auth()->id())
            ->selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();
        if($usersReaction){
            return true;
        }
        return false;
    }
}
