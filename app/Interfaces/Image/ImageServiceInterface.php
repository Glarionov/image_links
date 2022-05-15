<?php

namespace App\Interfaces\Image;

use Illuminate\Http\Request;

interface ImageServiceInterface
{
    /**
     * Display a listing of the images.
     *
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request);
}
