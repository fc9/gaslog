<?php

namespace App\Http\Controllers\Auth;

use \Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Validator;

abstract class ApiController extends Controller
{
    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function signUp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users,email|confirmed',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:educator,student',
            ]);
            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }
            $payload = $request->only(['email', 'password', 'role']);
            $this->authService->signup($payload);
            return response()->json('', 201);
        } catch (Throwable $th) {
            return $this->errorResponse($th);
        }
    }

    public function signIn(Request $request)
    {
        try {
            $payload = $request->only(['email', 'password']);
            $response = $this->authService->login($payload);
            return response()->json($response);
        } catch (Throwable $th) {
            return $this->errorResponse($th);
        }
    }

    public function passwordRestore(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|exists:users,email',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $payload = $request->only(['email']);
            $response = $this->authService->restore($payload);

            return response()->json($response);
        } catch (Throwable $th) {
            return $this->errorResponse($th);
        }
    }

    public function passwordReset(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'token' => 'required|exists:password_resets,token',
                'password' => 'required|min:6|confirmed'
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors());
            }

            $payload = $request->only(['token','password','password_confirmation']);
            $response = $this->authService->reset($payload);

            return response()->json($response);
        } catch (Throwable $th) {
            return $this->errorResponse($th);
        }
    }

    protected function errorResponse(Throwable $th)
    {
        return response()->json([
            'message' => $th->getMessage()
        ], 400);
    }
}