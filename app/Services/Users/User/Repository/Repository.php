<?php

namespace App\Services\Users\User\Repository;

use App\Models\Users\User;
use App\Helpers\Hasher\Contracts\HasherInterface;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;

class Repository extends RepositoryAbstract implements UserRepository
{
    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * Repository constructor.
     * @param HasherInterface $hasher
     */
    public function __construct(HasherInterface $hasher)
    {
        parent::__construct();
        $this->hasher = $hasher;
    }

    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return User::class;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if ($data['password']) {
            $data['password'] = $this->hasher->make($data['password']);
        }

        return $this->className::create($data);
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getWithNestedRelationsById(int $userId): User
    {
        return $this->className::with([
                'role',
                'profile.position',
                'profile.academicDegree',
                'profile.academicTitle',
                'profile.department'
            ])->whereId($userId)->firstOrFail();
    }
}
