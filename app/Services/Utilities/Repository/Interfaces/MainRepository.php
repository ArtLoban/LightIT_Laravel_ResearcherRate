<?php

namespace App\Services\Utilities\Repository\Interfaces;

interface MainRepository
{
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @return mixed
     */
    public function delete($model);
}
