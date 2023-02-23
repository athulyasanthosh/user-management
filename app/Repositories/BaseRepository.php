<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository.
 *
 * @package namespace App\Repositories;
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @author athulya <athulyasanthosh95@gmail.com>
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @author athulya <athulyasanthosh95@gmail.com>
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Find by Id
     *
     * @author athulya <athulyasanthosh95@gmail.com>
     *
     * @param $id - Id of data to return
     * @return Model - return respective model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}
