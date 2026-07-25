<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\ActivityLog;
use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected string $modelClass = User::class;
    protected array $registerRules = [
        'username' => 'required|string|unique:users',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string'
    ];
    protected array $loginRules = [
        'email' => 'required|email',
        'password' => 'required|min:5'
    ];

    public function login(Request $request)
    {
        $credentials = validate($request, $this->loginRules);

        if (!Auth::attempt($credentials)) {
            throw new ApiException('UNAUTHENTICATED','User is unauthenticated.', 401);
        }
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        ActivityLogService::log('login', $user->username . ' logged in.');
        return \response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = \auth()->user();
        $user->currentAccessToken()->delete();
        ActivityLogService::log('logout', $user->username . ' logged out.');
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function register(Request $request)
    {
        $newUser = validate($request, $this->registerRules);
        $user = User::where('email', $newUser['email'])->first();
        if ($user) {
            throw new ApiException('USER_ALREADY_EXISTS', class_basename($this->modelClass) . ' already exists', 409);
        }
        try {
            User::create($newUser);
            ActivityLogService::log('register', $newUser['username'] . ' registered.');
            return response()->json([
                'message' => 'User created successfully!'
            ], 200);
        } catch (\Throwable $e) {
            throw new ApiException('SERVER_ERROR', $e->getMessage(), 500);
        }
    }
}

