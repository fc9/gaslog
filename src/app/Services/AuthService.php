<?php

namespace App\Services;

use App\Enums\UserType;
use App\Helpers\Stage;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Exceptions\DuplicateResourceException;
use App\Services\Interfaces\AuthServiceInterface;
use App\Notifications\PasswordReset;
use Illuminate\Support\Str;
use Carbon\Carbon;


class AuthService implements AuthServiceInterface
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function signup($payload = [])
    {
        $alreadyExists = $this->userModel->where(['email' => $payload['email']])->exists();

        if ($alreadyExists) {
            throw new Exception("Este email já está cadastrado");
        }

        $user = (new $this->userModel)->fill($payload);
        $user->save();

        // Loga usuário com ID
        $success = Auth::guard('web')->loginUsingId($user->id);

        if (!$success) {
            throw new Exception("Erro interno, por favor entre em contato com suporte.");
        }

        return Auth::user();
    }

    public function login($payload = [])
    {
        $success = Auth::guard('web')->attempt($payload);
        if (!$success) {
            throw new Exception("Usuário/senha inválidos");
        }

        $user = Auth::user();
        if ($user->level !== UserType::USER) {
            return ["redirectTo" => "admin"];
        }

        return $user->email;
    }

    public function restore($payload = []) {

        $user = $this->userModel->where(['email' => $payload['email']])->first();

        if (!$user) {
            throw new Exception("Email inválido");
        }
        elseif( $user->provider_user_id ) {
            throw new Exception("Parece que você cadastrou-se utilizando uma rede social");
        }

        $token = Str::random(80);
        $email = $user->email;

        //Create Password Reset Token
        $result = \DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if(!$result) {
            throw new Exception("Tivemos uma falha ao restaurar sua senha. Entre em contato com o suporte.");
        }

        return $user->notify(new PasswordReset($token));

    }

    public function reset($payload = []) {

        //Create Password Reset Token
        $resetPassword = \DB::table('password_resets')->where("token",$payload['token'])->first();

        if(!$resetPassword) {
            throw new Exception("Tivemos uma falha ao resetar sua senha. Token inválido.");
        }

        $user = $this->userModel->where('email',$resetPassword->email)->first();

        if(!$user) {
            throw new Exception("Tivemos uma falha ao resetar sua senha. Seu e-mail não foi localizado.");
        }

        $user->password = $payload['password'];

        $user->save();

        \DB::table('password_resets')->where('email', $resetPassword->email)->delete();

        return $user;
    }
}
