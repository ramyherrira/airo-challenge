<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Authentication;

class LoginController extends Controller
{
    public function __construct(protected Authentication $auth) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        try {
            $token = $this->auth->authenticate($request->username, $request->password);

            return response()->json(['token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 401);
        }
    }
}
