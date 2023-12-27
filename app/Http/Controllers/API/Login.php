<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends BaseController
{
    public function index(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $expireAt = Carbon::now()->addMinutes(1);
            $success = [
                'token' => $user->createToken($user->name, ['*'], $expireAt)->plainTextToken,
                'name' => $user->name
            ];

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
