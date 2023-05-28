<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    const TOKEN_LIMIT = 1;
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $this->createToken($user);
    
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }
    }

    private function createToken(\Illuminate\Contracts\Auth\Authenticatable $user){
        $tokenCount = DB::table('personal_access_tokens')
            ->where('tokenable_id', $user->id)
            ->count();
        if ($tokenCount >= self::TOKEN_LIMIT) {
            // Obtener el token más antiguo del usuario
            $oldestToken = $user->tokens()
                ->latest()
                ->first();
            
            // Eliminar el token más antiguo
            $oldestToken->delete();
        }
        return $user->createToken('authToken')->plainTextToken;
    }
}
