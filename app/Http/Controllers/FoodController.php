<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\File;
use Illuminate\Support\Str;
use App\Interfaces\FoodInterface;
use App\Http\Requests\Food\StoreRequest;

class FoodController extends Controller
{
    private $foodInterface;

    public function __construct(FoodInterface $foodInterface)
    {
        $this->foodInterface = $foodInterface;
    }

    public function index()
    {
        $results = $this->foodInterface->getAll();

        return Inertia::render('Food/Index', [
            'results' => $results,
        ]);
    }

    public function create()
    {
        return Inertia::render('Food/Create');
    }

    public function store(StoreRequest $request)
    {
        $random = Str::random(10);
        $path = "foto/{$random}.webp";

        File::upload($path, base64_decode($request->foto));

        $this->foodInterface->store([
            'nama' => $request->nama,
            'foto' => $path,
            'harga' => $request->harga,
        ]);

        return redirect()->route('foods.index')
            ->with('success', 'Berhasil tambah data');
    }
}
