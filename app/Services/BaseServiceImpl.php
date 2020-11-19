<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

class BaseServiceImpl implements BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseServiceImpl constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        $model = $this->model->newInstance();
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function find($id): ?Model
    {
        $model = $this->model->find($id);

        return $model;
    }
}