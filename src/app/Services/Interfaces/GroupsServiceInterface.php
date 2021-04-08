<?php

namespace App\Services\Interfaces;


use App\Models\Group;

interface GroupsServiceInterface
{
    public function getByUser(int $id);
    public function create($payload = []): Group;
    public function update(int $id, $payload = []): Group;
    public function find(int $id): Group;
    public function delete(int $id): void;
}
