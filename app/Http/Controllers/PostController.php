<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $values = $request->validate(['title' => 'required|string|min:5|max:100', 'body' => 'required|string|min:10', 'user_id' => 'required']);

        if ($values) {
            try {
            DB::beginTransaction();
            Post::create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => $request->user_id
            ]);
            $user = currentUser();
                if ($user) {
                    Log::create([
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'log' => 'created post.'
                    ]);
                }
            DB::commit();
            return response()->json(['message' => 'Post created successfully.'], 200);
            }catch (\Exception $e){
                DB::rollBack();
                return response()->json(['error'=>$e],500);
            }
        }
            return response()->json([], 400);
    }

    public function updatePost(Request $request)
    {
        $credentials = $request->validate(['title' => 'required|string|min:5', 'body' => 'required|string|min:10', 'user_id' => 'required']);
        if ($credentials) {
            try {
                DB::beginTransaction();
                Post::where('id', $request->id)->update([
                    'title' => $request->title,
                    'body' => $request->body,
                    'user_id' => $request->user_id
                ]);
                $user = currentUser();
                if ($user) {
                    Log::create([
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'log' => 'updated post.'
                    ]);
                }
                DB::commit();
                return response()->json(['message' => 'Updated successfully.'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e], 500);
            }
        }
        return response()->json([], 400);
    }

    public function deletePost($id)
    {
        try {
            DB::beginTransaction();
            $post = Post::find($id);
            $post->delete();
            $user = Auth::user();
            if ($user) {
                Log::create([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'log' => 'deleted post.'
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Post deleted.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 500);
        }
    }

    public function posts()
    {
        return Post::orderBy('created_at', 'DESC')->get();
    }

    public function singlePost($id)
    {
        return Post::find($id);
    }
}
