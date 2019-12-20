<?php


namespace App\Support\Search;

class ProductSearch
{
    private $model;
    private $relationModel;

    public function __construct(string $model, string $relationModel = null)
    {
        $this->model = $model;
        $this->relationModel = $relationModel;
    }

    public function byString(string $query, string $column = 'name')
    {
        return $this->model::where($column, 'LIKE', '%' . $query . '%')->paginate(10);
    }

    public function byCategory(int $key, $relationship = null)
    {
        if ($this->relationModel != null) {
            return $this->relationModel::where('id', $key)->firstOrFail()->$relationship;
        } else {
            throw new \Exception('Para usar esse método, é necessário um model de relacionamento.');
        }
    }

    public function default()
    {
        return $this->model::paginate();
    }
}
