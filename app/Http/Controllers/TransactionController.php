<?php

namespace App\Http\Controllers;

use App\Interfaces\FoodInterface;
use Inertia\Inertia;

class TransactionController extends Controller
{
    private $foodInterface;

    public function __construct(FoodInterface $foodInterface)
    {
        $this->foodInterface = $foodInterface;
    }

    public function index()
    {
        $foods = $this->foodInterface->getAll();

        return Inertia::render('Transaction/Index', [
            'foods' => $foods,
        ]);
    }
}
