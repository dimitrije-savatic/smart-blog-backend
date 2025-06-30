<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function testimonials()
    {
        return DB::table('testimonials')->join('users', 'testimonials.user_id', '=', 'users.id')->select('testimonials.testimonial', 'users.first_name', 'users.last_name', 'users.email')->get();
    }
}
