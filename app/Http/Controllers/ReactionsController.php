<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReactionsController extends Controller
{
    //Comments
    public function getCommentsByPost($post_id)
    {
        return DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')->where('post_id', $post_id)->select('comments.*', 'users.first_name', 'users.last_name')->get();
    }

    public function getComments()
    {
        return Comment::all();
    }

    public function postComment(Request $request)
    {
        $credentials = $request->validate(['body'=>'required|string|min:5', 'user_id'=>'required', 'post_id'=>'required']);
        if ($credentials) {
            try {
                DB::beginTransaction();
                Comment::create([
                    'body' => $request->body,
                    'user_id' => $request->user_id,
                    'post_id' => $request->post_id
                ]);
                DB::commit();
                return response()->json(['message' => 'Comment posted successfully'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => $e], 500);
            }
        }
        return response()->json([], 400);
    }

    //Likes
    public function getLikes()
    {
        return Like::all();
    }

    public function getLikesByPost($id)
    {
        return Like::where('post_id', $id)->get();
    }

    public function likePost(Request $request)
    {
        $credentials = $request->only('post_id', 'user_id');
        $like = Like::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();
        if ($like){
            return response()->json(['error'=>'Already liked'], 409);
        }
        if ($credentials){
            try {
                DB::beginTransaction();
                Like::create([
                    'post_id' => $request->post_id,
                    'user_id' => $request->user_id
                ]);
                DB::commit();
                return response()->json(['success'=>'Liked'], 200);
            }catch (\Exception $e){
                DB::rollBack();
                return response()->json(['error'=>$e], 500);
            }
        }
        return response()->json([],400);
    }

    //Dislikes
    public function getDislikes()
    {
        return Dislike::all();
    }

    public function getDislikesByPost($id)
    {
        return Dislike::where('post_id', $id)->get();
    }

    public function dislikePost(Request $request)
    {
        $credentials = $request->only('post_id', 'user_id');
        $dislike = Dislike::where('post_id', $request->post_id)->where('user_id', $request->user_id)->first();
        if ($dislike){
            return response()->json(['error'=>'Already disliked'], 409);
        }
        if ($credentials){
            try {
                DB::beginTransaction();
                Dislike::create([
                    'post_id' => $request->post_id,
                    'user_id' => $request->user_id
                ]);
                DB::commit();
                return response()->json(['success'=>'Disliked'], 200);
            }catch (\Exception $e){
                DB::rollBack();
                return response()->json(['error'=>$e], 500);
            }
        }
        return response()->json([],400);
    }
}
