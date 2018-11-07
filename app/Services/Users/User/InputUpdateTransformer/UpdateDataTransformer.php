<?php

namespace App\Services\Users\User\InputUpdateTransformer;

use App\Helpers\Hasher\Contracts\HasherInterface;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;

class UpdateDataTransformer implements DataTransformer
{
    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * UpdateDataTransformer constructor.
     * @param HasherInterface $hasher
     */
    public function __construct(HasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        return is_null($data['password']) ? $this->removePasswordData($data) : $this->preparePasswordData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function removePasswordData(array $data): array
    {
        unset($data['password']);

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function preparePasswordData(array $data): array
    {
        $data['password'] = $this->hashPassword($data['password']);

        return $data;
    }

    /**
     * @param string $password
     * @param HasherInterface $hasher
     * @return string
     */
    private function hashPassword(string $password): string
    {
        return $this->hasher->make($password);
    }
}
