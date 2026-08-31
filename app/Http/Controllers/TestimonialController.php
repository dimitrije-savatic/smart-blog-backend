<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{

    protected string $modelClass = Testimonial::class;
    protected array $createRules = ['testimonial' => 'required|string|min:10|max:255', 'user_id' => 'required|integer'];
    protected array $updateRules = ['testimonial' => 'string|min:10|max:255', 'user_id' => 'integer'];

    public function getTestimonials()
    {
        return Testimonial::with('user')->orderByDesc('testimonials.created_at')->get();
    }

    public function createTestimonial(Request $request){
        return $this->create($request, $this->createRules);
    }

    public function updateTestimonial(Request $request, int $id){
        return $this->update($request, $id, $this->updateRules);
    }

    public function deleteTestimonial(int $id){
        return $this->delete($id);
    }
}
