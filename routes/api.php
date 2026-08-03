<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Authenticated User only routes
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        //Posts
        Route::delete('/posts/{id}', [\App\Http\Controllers\PostController::class, 'deletePost']);
        Route::put('/posts/{id}', [\App\Http\Controllers\PostController::class, 'updatePost']);

        //Categories
        Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'createCategory']);
        Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'deleteCategory']);
        Route::put('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'updateCategory']);
    });
    //Posts
    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'createPost']);

    //Comments
    Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'addComment']);
    Route::put('/comments/{id}', [\App\Http\Controllers\CommentController::class, 'updateComment']);
    Route::delete('/comments/{id}', [\App\Http\Controllers\CommentController::class, 'deleteComment']);

    //Reactions
    Route::post('/reactions', [\App\Http\Controllers\ReactionController::class, 'addReaction']);
    Route::delete('/reactions/{id}', [\App\Http\Controllers\ReactionController::class, 'deleteReaction']);

    //Testimonials
    Route::post('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'createTestimonial']);
    Route::put('/testimonials/{id}', [\App\Http\Controllers\TestimonialController::class, 'updateTestimonial']);
    Route::delete('/testimonials/{id}', [\App\Http\Controllers\TestimonialController::class, 'deleteTestimonial']);

    //Email
    Route::post('/send-email', [\App\Http\Controllers\EmailController::class, 'sendEmail']);

    //Auth
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

// GET routes
Route::middleware('reject.get.body')->group(function () {
    //Posts
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'getPosts']);
    Route::get('/posts/latest', [\App\Http\Controllers\PostController::class, 'getLatestPosts']);
    Route::middleware('optional.auth')->get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'getPost']);

    //Categories
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'categories']);
    Route::get('categories/{id}', [\App\Http\Controllers\CategoryController::class, 'categoryById']);

    //Users
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'users']);
    Route::get('/users/count', [\App\Http\Controllers\UserController::class, 'getUsersCount']);
    Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'user']);

    //Comments
    Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'getComments']);
    Route::get('/comments/count', [\App\Http\Controllers\CommentController::class, 'getCommentsCount']);
    Route::middleware('optional.auth')->get('/comments/{post_id}', [\App\Http\Controllers\CommentController::class, 'getCommentsByPost']);

    //Reactions
    Route::get('/reactions', [\App\Http\Controllers\ReactionController::class, 'getReactions']);
    Route::get('/reactions/count', [\App\Http\Controllers\ReactionController::class, 'getReactionsCount']);
    Route::get('/reactions/{reactable_id}', [\App\Http\Controllers\ReactionController::class, 'getReactionsByPost']);


    //Testimonials
    Route::get('/testimonials', [\App\Http\Controllers\TestimonialController::class, 'getTestimonials']);

    //ActivityLog
    Route::get('/logs', [\App\Http\Controllers\ActivityLogController::class, 'logs']);

    //Counts
    Route::get('/counts',[\App\Http\Controllers\ReactionController::class, 'counts']);
});

// Auth routes
Route::middleware('block.auth')->group(function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
});
