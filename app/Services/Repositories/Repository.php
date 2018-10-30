<?php

namespace App\Services\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class Repository
{
    /**
     * @var string
     */
    protected $className;

    /**
     * Repository constructor.
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
     * @return Collection|null
     */
    public function all()
    {
        return $this->className::all();
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
     * @return bool|null
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
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }
}
