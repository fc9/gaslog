<?php

namespace App\Services\Interfaces;


interface OAuthServiceInterface
{
    public function login($payload = [], $provider = '');
    public function signup($payload = [], $provider = '');
}
