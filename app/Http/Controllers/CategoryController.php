<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function categories()
    {
        return Category::orderBy('updated_at', 'DESC')->get();
    }

    public function categoriesByPost($id)
    {
        return DB::table('categories')
            ->whereIn('categories.id', function ($query) use ($id) {
                $query->select('post_categories.categories_id')
                    ->from('post_categories')
                    ->where('post_categories.post_id', $id);
            })
            ->select('categories.name', 'categories.id')
            ->get();
    }

    public function category($id)
    {
        return Category::find($id);
    }

    public function createCategory(Request $request)
    {
        $name = $request->validate(['name' => 'required|min:3|max:20']);
        try {
            DB::beginTransaction();
            Category::create($name);
            $user = currentUser();
            if ($user) {
                Log::create([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'log' => 'created category.'
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Category created.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Bad request.'], 400);
        }
    }

    public function deleteCategory($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::find($id);
            $category->delete();
            $user = currentUser();
            if ($user) {
                Log::create([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'log' => 'deleted category.'
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Category deleted.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e], 500);
        }
    }

    public function updateCategory(Request $request)
    {
        $credentials = $request->validate(['name' => 'required|min:3|max:20']);
        if ($credentials) {
            try {
                DB::beginTransaction();
                $category = Category::find($request->id);
                $category->name = $request->name;
                $category->save();
                $user = currentUser();
                if ($user) {
                    Log::create([
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'log' => 'updated category.'
                    ]);
                }
                DB::commit();
                return response()->json(['message' => 'Updated successfully'], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e], 500);
            }
        }
        return response()->json([], 400);
    }
}
