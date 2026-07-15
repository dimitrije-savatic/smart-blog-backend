<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
        return $posts = Post::latest()->with('categories')->with('reactions')->take(3)->get();
    }

    public function getPost(int $id)
    {
        return response()->json($this->postService->getPostDetails($id));
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

    public function reactToPost(Request $request)
    {
        $this->reactRules = [
            'user_id' => 'required|integer',
            'reactable_id' => 'required|integer',
            'reactable_type' => ['required', Rule::in(ReactableType::values())],
            'type' => ['required', Rule::in(ReactionType::values())],
        ];
        return $this->react($request);
    }
}
