<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required|min:5']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            Log::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'log' => 'logged in.'
            ]);
            return \response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        }

        return \response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $request->validate(['first_name' => 'required|min:3|max:20', 'last_name' => 'required|min:3|max:20', 'email' => 'required|email', 'password' => 'required|min:5']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            try {
                DB::beginTransaction();
                User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                Log::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'log' => 'successfully registered.'
                ]);
                DB::commit();
                return response()->json([
                    'message' => 'User created successfully!'
                ], 200);
            } catch (\Exception $e) {
                DB::rollBack();
                return \response()->json([
                    'error' => $e
                ], 500);
            }
        } else {
            return \response()->json([
                'error' => 'User already exists.'
            ], 409);
        }
    }
}

