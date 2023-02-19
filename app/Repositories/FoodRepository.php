<?php

namespace App\Repositories;

use App\Interfaces\FoodInterface;
use App\Models\Food;

class FoodRepository implements FoodInterface
{
    private $model;

    public function __construct(Food $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model
            ->orderBy('nama')
            ->get();
    }

    public function getById(string $id)
    {
        return $this->model
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model
            ->create($data);
    }
}
