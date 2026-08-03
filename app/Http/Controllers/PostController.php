<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Models\Post;
use App\Models\View;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    protected string $modelClass = Post::class;
    protected array $createRules = ['title' => 'required|string|min:5|max:100', 'body' => 'required|string|min:10', 'user_id' => 'required|integer', 'category_ids' => 'required|array|integer'];
    protected array $updateRules = ['title' => 'string|min:5|max:100', 'body' => 'string|min:10', 'category_ids' => 'array|integer'];

    protected function afterCreate(Request $request, Model $item) : void
    {
        $item->categories()->attach($request->category_ids);
    }

    protected function afterUpdate(Request $request,Model $item) : void
    {
        $item->categories()->sync($request->category_ids);
    }

    public function getPosts()
    {
        return Post::with('categories')->get();
    }

    public function getLatestPosts() {

        $posts = Post::latest()->with(['categories', 'comments'])->withCount('views')->take(3)->get();
        return response()->json($posts);
    }

    public function getPost(int $id)
    {
        $post = $this->postService->getPostDetails($id);
        $token = $this->recordView($post['id']);
        $response = response()->json($post);
        if ($token) {
            $response->cookie(
                'visitor_token',
                $token,
                60 * 24 * 90,
                '/',
                null,
                false, // secure false for localhost
                true,  // httpOnly
                false,
                'Lax'
            );
        }
        return $response;
    }

    public function createPost(Request $request)
    {
       return $this->create($request);
    }

    public function updatePost(Request $request, int $id)
    {
        return $this->update($request, $id);
    }

    public function deletePost(int $id)
    {
        return $this->delete($id);
    }

    private function recordView(int $post_id): ?string
    {
        if (auth()->check()) {

            $exists = View::where('post_id', $post_id)
                ->where('user_id', auth()->id())
                ->where('created_at', '>=', now()->subDay())
                ->exists();

            if (! $exists) {
                View::create([
                    'post_id' => $post_id,
                    'user_id' => auth()->id(),
                ]);
            }

            return null;
        }

        $token = Cookie::get('visitor_token');

        if (! $token) {
            $token = Str::uuid()->toString();

            $exists = false;
        } else {
            $exists = View::where('post_id', $post_id)
                ->where('visitor_token', $token)
                ->where('created_at', '>=', now()->subDay())
                ->exists();
        }

        if (! $exists) {
            View::create([
                'post_id' => $post_id,
                'visitor_token' => $token,
            ]);
        }

        return Cookie::get('visitor_token') ? null : $token;
    }

}
