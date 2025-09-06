<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        $token = $user->createToken('auth_token', ['user'])->plainTextToken;

        return response()->json([
            'message' => 'Register successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        if ($user->blocked == 1) {
            return response()->json([
                'message' => 'user is blocked'
            ], 401);
        }

        $token = $user->createToken('auth_token', ['user'])->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    public function block($id)
    {
        $user = User::findOrFail($id);

        $user->blocked = !$user->blocked;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => $user->blocked
                ? 'user is blocked'
                : 'user is unblocked'
        ]);
    }

    public function index()
    {
        $users = User::latest()->paginate(15);

        return UserResource::collection($users);
    }
}
