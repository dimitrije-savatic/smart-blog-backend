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
        return Testimonial::select('testimonials.testimonial', 'users.first_name', 'users.last_name', 'users.email')->
        join('users', 'testimonials.user_id', '=', 'users.id')->
        orderBy('testimonials.created_at', 'desc')->get();
    }

    public function createTestimonial(Request $request){
        return $this->create($request);
    }

    public function updateTestimonial(Request $request, int $id){
        return $this->update($request, $id);
    }

    public function deleteTestimonial(int $id){
        return $this->delete($id);
    }
}
