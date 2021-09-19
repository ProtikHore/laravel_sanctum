<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::Check($request->password, $user->password)) {
            return response([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('mr_token')->plainTextToken;
    }

    public function getUserAll() {
        $allUser = User::get();
        return response()->json($allUser);
    }

    public function getUser($id) {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    public function logout(Request $request) {
        //$this->guard()->logout();
        $data = $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out', 'data' => $data]);
    }
}
