<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected string $modelClass = Category::class;
    protected array $createRules = ['name' => 'required|min:3|max:20'];
    protected array $updateRules = ['name' => 'min:3|max:20'];

    protected function beforeDelete(Model $item) : void
    {
      $item->posts()->detach();
    }

    public function categories()
    {
        return $this->getAll();
    }

    public function categoryById(int $id)
    {
        return $this->getById($id);
    }

    public function createCategory(Request $request)
    {
        return $this->create($request, $this->createRules);
    }

    public function deleteCategory(int $id)
    {
        return $this->delete($id);
    }

    public function updateCategory(Request $request, int $id)
    {
        return $this->update($request, $id, $this->updateRules);
    }
}
