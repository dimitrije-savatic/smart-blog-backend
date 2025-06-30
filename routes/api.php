<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Posts
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'posts']);
Route::get('/posts/post/{id}', [\App\Http\Controllers\PostController::class, 'singlePost']);
Route::post('/posts/create', [\App\Http\Controllers\PostController::class, 'createPost']);
Route::delete('/posts/delete/{id}', [\App\Http\Controllers\PostController::class, 'deletePost']);
Route::put('/posts/update', [\App\Http\Controllers\PostController::class, 'updatePost']);


//Categories
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'categories']);
Route::get('/categories/post/{id}', [\App\Http\Controllers\CategoryController::class, 'categoriesByPost']);
Route::get('categories/{id}', [\App\Http\Controllers\CategoryController::class, 'category']);
Route::post('/categories/create', [\App\Http\Controllers\CategoryController::class, 'createCategory']);
Route::delete('/categories/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'deleteCategory']);
Route::put('/categories/update', [\App\Http\Controllers\CategoryController::class, 'updateCategory']);

//Users
Route::get('/users', [\App\Http\Controllers\UserController::class, 'users']);
Route::get('/users/user/{id}', [\App\Http\Controllers\UserController::class, 'user']);


// Auth
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

//Comments
Route::get('/comments', [\App\Http\Controllers\ReactionsController::class, 'getComments']);
Route::get('/comments/{post_id}', [\App\Http\Controllers\ReactionsController::class, 'getCommentsByPost']);
Route::post('/comments', [\App\Http\Controllers\ReactionsController::class, 'postComment']);

//Likes
Route::get('/likes', [\App\Http\Controllers\ReactionsController::class, 'getLikes']);
Route::get('/likes/{post_id}', [\App\Http\Controllers\ReactionsController::class, 'getLikesByPost']);
Route::post('/likes', [\App\Http\Controllers\ReactionsController::class, 'likePost']);

//Dislikes
Route::get('/dislikes', [\App\Http\Controllers\ReactionsController::class, 'getDislikes']);
Route::get('/dislikes/{post_id}', [\App\Http\Controllers\ReactionsController::class, 'getDislikesByPost']);
Route::post('/dislikes', [\App\Http\Controllers\ReactionsController::class, 'dislikePost']);

//Testimonials
Route::get('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'testimonials']);

//Email
Route::post('/send-email', [\App\Http\Controllers\EmailController::class, 'sendEmail']);

//Log
Route::get('/logs', [\App\Http\Controllers\LogController::class, 'logs']);


