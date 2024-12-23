<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function findById(int $id)
    {
        return $this->model->find($id);
    }
    public function create($data)
    {
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        $model = $this->findById($id);
        return $model->update($data);
    }
    public function delete($id)
    {
        $model = $this->findById($id);
        return $model->delete();
    }
}
