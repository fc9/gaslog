<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Exceptions\DuplicateResourceException;
use App\Services\Interfaces\OAuthServiceInterface;
use Illuminate\Support\Str;

class OAuthService implements OAuthServiceInterface
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function login($payload = [], $provider = '')
    {
        // Verifica se usuário já fez cadastro com email anteriormente sem oAuth
        $alreadyExists = $this->userModel->where('email', $payload['email'])->whereNull('provider_user_id')->exists();

        if ($alreadyExists) {
            throw new Exception("Este e-mail cadastrou-se sem utilizar uma rede social.");
        }

        $user = $this->userModel->where('provider_user_id',$payload['id'])->first();

        if(!$user) {
            throw new Exception("Você ainda não possui uma conta cadastrada.");
        }
        
        // Loga usuário com ID
        $success = Auth::guard('web')->loginUsingId($user->id);

        if (!$success) {
            throw new Exception("Erro interno, por favor entre em contato com suporte.");
        }

        return Auth::user();
    }

    public function signup($payload = [], $provider = '')
    {
        // Verifica se usuário já fez cadastro com email anteriormente sem oAuth
        $alreadyExists = $this->userModel->where('email', $payload['email'])->whereNull('provider_user_id')->exists();

        if ($alreadyExists) {
            throw new Exception("Este e-mail cadastrou-se sem utilizar uma rede social.");
        }

        // Retorna usuário já existente, senão existe cria.
        $user = $this->userModel->firstOrCreate(
            ['provider_user_id' => $payload['id']],
            [
                'email' => $payload['email'],
                'provider' => $provider,
                'provider_user_id' => $payload['id'],
                'password' => Str::random(40),
                'role' => $payload['role'],
            ]
        );

        // Loga usuário com ID
        $success = Auth::guard('web')->loginUsingId($user->id);

        if (!$success) {
            throw new Exception("Credenciais inválidas.");
        }

        return Auth::user();
    }
}
