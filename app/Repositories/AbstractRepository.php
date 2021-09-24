<?php

namespace app\Repositories;

use Illuminate\Support\Facades\Auth;

class AbstractRepository{
    
    protected $obj;

    protected function __construct(object $obj)
    {
        $this->obj = $obj;
    }

    public function all() : object
    {
        return $this->obj->all();
    }

    public function find(int $id)
    {
        return $this->obj->find($id);
    }

    public function findUser(int $id)
    {
        return $this->obj->where('user_id', Auth::user()->id)->where('id', $id)->first();
    }

    public function findByColumn(string $column, $value): object
    {
        return $this->obj->where($column, $value)->get();
    }

    public function save(array $attributes): object
    {
        return $this->obj->create($attributes);
    }

    public function insert(array $attributes): bool
    {
        return $this->obj->insert($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->obj->find($id)->update($attributes);
    }

    public function delete(int $id)
    {
         return $this->obj->destroy($id);
    }

    public function search($search)
    {
        $query = $this->obj->query();
        foreach ($search as $key => $value) {
            if(!is_null($key) && !is_null($value)){
                $query->where($key, 'like', '%' . $value . '%');
            }
        }
        return $query->get();
    }
}