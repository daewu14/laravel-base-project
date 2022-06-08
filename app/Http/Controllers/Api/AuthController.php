<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\LoginRepository\Models\LoginData;
use App\Repositories\RegisterRepository\Models\RegisterData;
use App\Services\LoginUser\LoginService;
use App\Services\RegisterUser\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = new RegisterData;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->current_password = $request->password;

        return response()->json((new RegisterService($data))->call());
    }

    public function login(Request $request)
    {
        $data = new LoginData;
        $data->email = $request->email;
        $data->password = $request->password;

        return response()->json((new LoginService($data))->call());
        
    }

    // method for user logout and delete token
    public function logout()
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged'
        ];
    }
}
