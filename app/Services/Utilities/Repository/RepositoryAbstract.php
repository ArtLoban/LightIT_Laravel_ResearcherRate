<?php

namespace App\Services\Utilities\Repository;

use App\Services\Utilities\Repository\Interfaces\MainRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class RepositoryAbstract implements MainRepository
{
    /**
     * @var string
     */
    protected $className;

    /**
     * RepositoryAbstract constructor.
     */
    public function __construct()
    {
        $this->className = $this->getClassName();
    }

    /**
     * @return string
     */
    abstract protected function getClassName(): string;

    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return $this->className::create($params);
    }

    /**
     * @return Collection|null
     */
    public function all(): ?Collection
    {
        return $this->className::all();
    }

    /**
     * @param array $relations
     * @return Collection|null
     */
    public function allWithRelations(array $relations): ?Collection
    {
        return $this->className::with($relations)->get();
    }

    /**
     * @param int $id
     * @param string $relations
     * @return mixed
     */
    public function getWithRelations(int $id, string $relations)
    {
        return $this->className::with($relations)->whereId($id)->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function whereId(int $id)
    {
        return $this->className::whereId($id)->first();
    }

    /**
     * @param int $id
     * @param array $params
     * @return Model
     */
    public function updateById(int $id, array $params)
    {
        $model = $this->whereId($id);

        if (! $model) {
            throw new ModelNotFoundException();
        }

        $model->update($params);

        return $model;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function deleteById(int $id)
    {
        $model = $this->whereId($id);

        if (! $model) {
            throw new ModelNotFoundException();
        }

        return $this->delete($model);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }
}