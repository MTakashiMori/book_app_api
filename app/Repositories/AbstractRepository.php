<?php

namespace App\Repositories;

use App\Models\AbstractModel;
use Illuminate\Database\Query\Builder;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
class AbstractRepository
{

    /**
     * @var $relationship []
     */
    protected $relationship;

    /**
     * @var AbstractModel $model
     */
    protected $model;

    /**
     * @var $appends
     */
    protected $appends;

    /**
     * @var $foreignKeyName
     */
    protected $foreignKeyName;

    /**
     * Repository constructor.
     * @param $relationship
     * @param AbstractModel $model
     * @param $appends
     * @param null $foreignKeyName
     */
    public function __construct($relationship, AbstractModel $model, $appends = [], $foreignKeyName = null)
    {
        $this->relationship = $relationship;
        $this->model = $model;
        $this->appends = $appends;
        $this->foreignKeyName = $foreignKeyName;
    }

    /**
     * @param $request
     * @param $field
     * @param $order
     * @param bool $relationship
     * @return Builder
     */
    public function all($request, $field = null, $order = null, $relationship = false)
    {
        $data = $this->model;

        if($field || $order) {
            (filter_var($order, FILTER_VALIDATE_BOOLEAN)) ?
                $order = 'DESC' :
                $order = 'ASC';

            $data = $data->orderBy($field, $order);
        }

        $data = $data->orderBy('id');

        if($request)
        {
            return $data->like($request);
        }

        return $data->with($relationship ? $relationship : $this->relationship);
    }

    /**
     * @param $id
     * @param bool $relationship
     * @return mixed
     */
    public function find($id, $relationship = true)
    {
        if($relationship) {
            return $this->model->with($this->relationship)->find($id);
        }
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @param bool $return
     * @return mixed
     */
    public function update($data, $id, $return = false)
    {
        unset($data['id']);

        $response = $this->model
            ->find($id)
            ->update($data);

        return $return ?
            $this->model->find($id) :
            $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @return string
     */
    public function getForeignKeyName()
    {
        return $this->foreignKeyName;
    }


}
