<?php

namespace App\Http\Controllers\Auth;


use \Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\OAuthServiceInterface;

class OAuthController extends Controller
{
    protected OAuthServiceInterface $oAuthService;

    public function __construct(OAuthServiceInterface $oAuthService)
    {
        $this->oAuthService = $oAuthService;
    }

    public function login(Request $request, $provider)
    {
        try {
            $payload = $request->only(['id', 'email']);

            $response = $this->oAuthService->login($payload, $provider);

            return response()->json($response);
        } catch (Throwable $th) {
            return $this->errorResponse($th);
        }
    }

    public function signup(Request $request, $provider)
    {
        try {
            $payload = $request->only(['id', 'email', 'role']);

            $response = $this->oAuthService->signup($payload, $provider);

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
