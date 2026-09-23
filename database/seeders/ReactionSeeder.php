<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        /*
         * Reaction distribution:
         *
         * like  = 50%
         * heart = 20%
         * fire  = 15%
         * happy = 10%
         * sad   =  5%
         */
        $reactionWeights = [
            'like'  => 50,
            'heart' => 20,
            'fire'  => 15,
            'happy' => 10,
            'sad'   => 5,
        ];

        // Reactions for posts
        foreach ($posts as $post) {
            $maxReactions = min(10, $users->count());

            if ($maxReactions === 0) {
                continue;
            }

            $numberOfReactions = rand(3, $maxReactions);

            $reactionUsers = $users->random($numberOfReactions);

            foreach ($reactionUsers as $user) {
                Reaction::create([
                    'user_id' => $user->id,
                    'reactable_id' => $post->id,
                    'reactable_type' => 'post',
                    'type' => $this->weightedReaction($reactionWeights),
                ]);
            }
        }

        // Reactions for comments
        foreach ($comments as $comment) {
            $maxReactions = min(5, $users->count());

            if ($maxReactions === 0) {
                continue;
            }

            $numberOfReactions = rand(1, $maxReactions);

            $reactionUsers = $users->random($numberOfReactions);

            foreach ($reactionUsers as $user) {
                Reaction::create([
                    'user_id' => $user->id,
                    'reactable_id' => $comment->id,
                    'reactable_type' => 'comment',
                    'type' => 'heart',
                ]);
            }
        }
    }

    private function weightedReaction(array $weights): string
    {
        $random = rand(1, array_sum($weights));

        foreach ($weights as $reaction => $weight) {
            $random -= $weight;

            if ($random <= 0) {
                return $reaction;
            }
        }

        return 'like';
    }
}
