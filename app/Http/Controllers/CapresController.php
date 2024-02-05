<?php

namespace App\Http\Controllers;

use App\Services\CapresService;

class CapresController extends Controller
{
    private CapresService $service;

    public function __construct(CapresService $capresService)
    {
        $this->service = $capresService;
    }
    public function index()
    {
        $data = $this->service->index();

        if ($data) {
            return view('index', $data);
        }
    }
}
