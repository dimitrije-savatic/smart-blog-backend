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
    protected array $createRules = ['title' => 'required|string|min:5|max:100', 'body' => 'required|string|min:10', 'user_id' => 'required|integer', 'category_ids'=> 'required|array'];
    protected array $updateRules = ['id' => 'number', 'title' => 'string|min:5|max:100', 'body' => 'string|min:10', 'image' => 'string', 'user_id' => 'integer', 'category_ids'=> 'array'];

    protected function afterCreate(Request $request, Model $item) : void
    {
        $item->categories()->attach($request->category_ids);
    }

    protected function afterUpdate(Request $request,Model $item) : void
    {
        $item->categories()->sync($request->category_ids);
    }

    protected function beforeDelete(Model $item): void
    {
        $item->categories()->detach();
    }

    public function getPosts(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
            'sort' => [
                'nullable',
                'in:newest,oldest,most-viewed,most-liked'
            ],
        ]);

        $query = Post::query()->with(['categories', 'author'])
            ->withCount([
                'views',
                'comments',
                'reactions as likes_count' => function ($q) {
                    $q->where('type', 'like');
                }
            ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Category
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Sorting
        switch ($request->input('sort')) {
            case 'oldest':
                $query->oldest();
                break;

            case 'most-viewed':
                $query->orderByDesc('views_count');
                break;

            case 'most-liked':
                $query->orderByDesc('likes_count');
                break;

            case 'newest':
            default:
                $query->latest();
                break;
        }
        return response()->json($query->get());
    }

    public function getLatestPosts() {

        $posts = Post::latest()->with('categories')->withCount(['views', 'comments'])->take(3)->get();
        return response()->json($posts);
    }

    public function getDetailedPost(int $id)
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
       return $this->create($request, $this->createRules);
    }

    public function updatePost(Request $request, int $id)
    {
        return $this->update($request, $id, $this->updateRules);
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
