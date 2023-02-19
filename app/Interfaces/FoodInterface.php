<?php

namespace App\Interfaces;

interface FoodInterface
{
    public function getAll();
    public function getById(string $id);
    public function store(array $data);
}
