<?php

namespace App\Http\Controllers;

use App\Enums\ReactableType;
use App\Enums\ReactionType;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReactionController extends Controller
{

    protected string $modelClass = Reaction::class;
    public function getReactions()
    {
        return $this->getAll();
    }

    public function getReactionsByPost(int $id)
    {
        return $this->getById($id);
    }

    public function addReaction(Request $request)
    {
        $this->createRules = [
            'user_id' => 'required|integer',
            'reactable_id' => 'required|integer',
            'reactable_type' => ['required', Rule::in(ReactableType::values())],
            'type' => ['required', Rule::in(ReactionType::values())],
        ];

        $this->create($request);
    }

    public function deleteReaction(int $id) {
        return $this->delete($id);
    }
}
