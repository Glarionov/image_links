<?php

namespace App\Services\Image;

use App\Interfaces\Image\ImageServiceInterface;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ImageServiceService implements ImageServiceInterface
{
    /**
     * Displays Images, filtering them by name
     * @param Request $request
     * @return Collection|array
     */
    public function list(Request $request): Collection|array
    {
        $filter = [];
        if ($request->has('search_text')) {
            $searchText = $request->input('search_text');
            if (strlen($searchText) > 3) {
                $filter[] = ['name', 'like', "%$searchText%"];
            }
        }
        return Image::query()->limit(10)->where($filter)->get();
    }
}
