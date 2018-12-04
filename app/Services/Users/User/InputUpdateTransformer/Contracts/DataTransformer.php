<?php

namespace App\Services\Users\User\InputUpdateTransformer\Contracts;

interface DataTransformer
{
    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array;
}
