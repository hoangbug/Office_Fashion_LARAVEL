<?php

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BaseRepository
{
    protected $model;

    abstract protected function model();

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * @throws BindingResolutionException
     */
    protected function makeModel()
    {
        $this->model = app()->make($this->model());
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            return $result->update($attributes);
        }
        return $result;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function paginate($columns = ['*'], $limit = 5, $order = null)
    {
        return $this->model->select($columns)->orderBy('id', $order)->paginate($limit);
    }

}
