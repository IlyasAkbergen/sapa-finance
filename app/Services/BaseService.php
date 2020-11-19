<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

interface BaseService
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
}