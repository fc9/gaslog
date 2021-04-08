<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Nullable;

interface Repository
{
    /**
     * @return array
     */
    public function create(): array;

    /**
     * @param array $payload
     *
     * @return Model|array|Nullable
     */
    public function store($payload = []);

    /**
     * @param int $id
     *
     * @return array
     */
    public function edit($id): array;

    /**
     * @param int $id
     * @param array $payload
     *
     * @return Model|array|Nullable
     */
    public function update($id, $payload = []): Model;
}
