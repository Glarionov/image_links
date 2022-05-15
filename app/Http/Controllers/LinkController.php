<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Interfaces\Link\LinkServiceInterface;
use App\Models\Link;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LinkController extends Controller
{
    public function __construct(private LinkServiceInterface $mainService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return $this->mainService->list();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkRequest $request
     * @return LinkResource
     */
    public function store(LinkRequest $request): LinkResource
    {
        $data = $request->validated();
        $link =  $this->mainService->store($data);
        return LinkResource::make($link);
    }

    /**
     * Display the specified resource.
     *
     * @param Link $link
     * @return LinkResource
     */
    public function show(Link $link): LinkResource
    {
        $link = $this->mainService->show($link);
        return LinkResource::make($link);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LinkRequest $request
     * @param Link $link
     * @return LinkResource
     */
    public function update(LinkRequest $request, Link $link): LinkResource
    {
        $link = $this->mainService->update($request, $link);
        return LinkResource::make($link);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return bool
     */
    public function destroy(Link $link): bool
    {
        return $this->mainService->destroy($link);
    }

    /**
     * @param string $uid
     * @return Response|StreamedResponse
     */
    public function getImageByLink(string $uid): Response|StreamedResponse
    {
        return $this->mainService->getImageByLink($uid);
    }
}
