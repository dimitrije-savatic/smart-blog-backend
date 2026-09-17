<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Services\ActivityLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class Controller
{
    protected string $modelClass;
    protected array $createRules = [];
    protected array $updateRules = [];
    protected array $reactRules = [];

    // ---- HOOKS ----

    protected function beforeCreate(array $data) {}

    protected function afterCreate(Request $request, Model $item): void {}

    protected function afterGetAll($items)
    {
        return $items;
    }

    protected function afterGetById($item)
    {
        return $item;
    }

    protected function beforeUpdate(Request $request): void {}

    protected function afterUpdate(Request $request, Model $item): void {}

    public function getById(int $id): \Illuminate\Http\JsonResponse
    {
        $item = ($this->modelClass)::find($id);
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        $item = $this->afterGetById($item);
        return response()->json($item);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        $items = ($this->modelClass)::all();
        if ($items->isEmpty()) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        $items = $this->afterGetAll($items);
        return response()->json($items);
    }

    public function create(Request $request,array $createRules): \Illuminate\Http\JsonResponse
    {
        $data = validate($request, $createRules);
        $this->beforeCreate($data);
        try {
            $item = ($this->modelClass)::create($data);
            $this->afterCreate($request, $item);
            ActivityLogService::log('create', auth()->user()->username . ' created ' . strtolower(class_basename($this->modelClass)) . '.', $item);
            $item->refresh();
            return response()->json("", 201);
        } catch (\Throwable $e) {
            throw new ApiException('SERVER_ERROR', $e->getMessage(), 500);
        }
    }

    public function update(Request $request, int $id,array $updateRules): JsonResponse
    {
        $item = ($this->modelClass)::find($id);
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        $this->beforeUpdate($request);
        $data = validate($request, $updateRules, [], 'update', [], $item);
        try {
            $item->update($data);
            $this->afterUpdate($request, $item);
            ActivityLogService::log('update', auth()->user()->username . ' updated ' . strtolower(class_basename($this->modelClass)) . '.', $item);
            return response()->json("", 204);
        } catch (\Throwable $e) {
            throw new ApiException('SERVER_ERROR', $e->getMessage(), 500);
        }
    }

    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $item = ($this->modelClass)::find($id);
        if (!$item) {
            throw new ApiException('NOT_FOUND', class_basename($this->modelClass) . ' not found.', 404);
        }
        try {
            $item->delete();
            ActivityLogService::log('delete', auth()->user()->username . ' deleted ' . strtolower(class_basename($this->modelClass)) . '.', $item);
            return response()->json("", 204);
        } catch (\Throwable $e) {
            throw new ApiException('SERVER_ERROR', $e->getMessage(), 500);
        }
    }

    public function react(Request $request, array $reactRules): \Illuminate\Http\JsonResponse
    {
        $data = validate($request, $reactRules);
        $existing = Reaction::where([
            'user_id' => auth()->id(),
            'reactable_id' => $data['reactable_id'],
            'reactable_type' => $data['reactable_type'],
        ])->first();
        $existingPost = Post::find($data['reactable_id']);
        $existingComment = Comment::find($data['reactable_id']);
        if (!$existingPost && !$existingComment) {
            return response()->json(['message' => 'Model you want to react to doesn\'t exist.'], 404);
        }

        //update if type is different
        if ($existing && $existing->type !== $data['type']){
            $existing->update(
                [
                    'user_id' => auth()->id(),
                    'reactable_id' => $data['reactable_id'],
                    'reactable_type' => $data['reactable_type'],
                    'type' => $data['type']
                ]
            );
            return response()->json("", 204);
        }

        // remove if same reaction
        if ($existing && $existing->type === $data['type']) {
            $existing->delete();

            return response()->json([
                'message' => 'Reaction removed.'
            ], 204);
        }

        // otherwise create/update
        $reaction = Reaction::create(
            [
                'user_id' => auth()->id(),
                'reactable_id' => $data['reactable_id'],
                'reactable_type' => $data['reactable_type'],
                'type' => $data['type']
            ]
        );

        return response()->json("", 201);
    }
}
