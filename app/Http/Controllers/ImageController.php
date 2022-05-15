<?php

namespace App\Http\Controllers;

use App\Interfaces\Image\ImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function __construct(private ImageServiceInterface $mainService)
    {
    }

    /**
     * Display a listing of the images.
     *
     * @param Request $request
     * @return Collection
     */
    public function index(Request $request): Collection
    {
        return $this->mainService->list($request);
    }
}
