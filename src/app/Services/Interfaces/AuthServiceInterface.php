<?php

namespace App\Services\Interfaces;


interface AuthServiceInterface
{
    public function signup($payload = []);
    public function login($payload = []);
    public function restore($payload = []);
    public function reset($payload = []);
}
