<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

class BaseServiceImpl implements BaseService
{
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

    public function all()
    {
        return $this->model->all();
    }

    public function allForUser($user_id)
    {
        return $this->model->whereHas('users', function ($q) use ($user_id) {
            $q->where('id', $user_id);
        });
    }

    public function with(array $relationships)
    {
        $this->model = $this->model->with($relationships);
    }

    public function allWith(array $relationships)
    {
        return $this->model->with($relationships)->get();
    }

    public function create(array $attributes): Model
    {
        $model = $this->model->newInstance();
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    public function find($id): ?Model
    {
        $model = $this->model->find($id);

        return $model;
    }

    public function findWith($id, array $relationships)
    {
        return $this->model->with($relationships)->find($id);
    }

    public function firstWhere(array $params)
    {
        $query = $this->model;

        foreach ($params as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query->first();
    }

    public function getWhere(array $params)
    {
        $query = $this->model;

        foreach ($params as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query->get();
    }

    public function update($id, array $attributes): Model
    {
        $model = $this->model->find($id);

        $model->update($attributes);

        return $model;
    }

    public function updateOrCreate(array $params,  array $attributes): Model
    {
        return $this->model->updateOrCreate($params, $attributes);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}