<?php

namespace App\Services\Link;

use App\Http\Resources\LinkCollection;
use App\Interfaces\Link\LinkServiceInterface;
use App\Models\Link;
use App\Services\AbstractResourceService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LinkServiceService extends AbstractResourceService implements LinkServiceInterface
{
    public function __construct()
    {
        parent::__construct(new Link());
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request|null $request
     * @return LengthAwarePaginator|ResourceCollection
     */
    public function list(Request $request = null): LengthAwarePaginator|ResourceCollection
    {
//        todo r
//        $links = $this->mainModel::query()->cursorPaginate($this->itemsPerPage);
        $links = $this->mainModel::query()->orderBy('id', 'desc')->paginate($this->itemsPerPage);

        return new LinkCollection(
            $links
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $requestData
     * @return Model
     */
    public function store(array $requestData): Model
    {
        $link = new Link();
        $link->fill($requestData);

        do {
            $text = Str::random(30);

            $existingLink = Link::query()->where('text', $text)->first();
        }
        while(!empty($existingLink));
        $link->text = $text;

        $link->save();
        return $link;
    }

    /**
     * @param string $uid
     * @return Response|StreamedResponse
     */
    public function getImageByLink(string $uid): Response|StreamedResponse
    {
        $link = Link::query()->with('image')->where('text', $uid)->firstOrFail();

        if ($link->expires_at && strtotime($link->expires_at) < time()) {
            return response('Expired link', 423);
        }

        if ($link->visits_left < 1) {
            return response('No visits left', 423);
        }

        $link->visits_left--;
        $link->save();

        $path = $link->image->path;
        $storagePath = Storage::path($path);
        if (File::exists($storagePath)) {
            return Storage::download($path);
        }

        $message = "Can't find file by storagePath";

        return response($message, 410);
    }
}
