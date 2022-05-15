<?php

namespace App\Services;

use App\Http\Requests\AbstractUpdateOrCreateRequest;
use App\Interfaces\AbstractResourceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Request;

class AbstractResourceService implements AbstractResourceInterface
{
    protected int $itemsPerPage = 20;

    public function __construct(protected Model $mainModel)
    {
    }

    /**
     * @param Request|null $request
     * @return LengthAwarePaginator|ResourceCollection
     */
    public function list(Request $request = null): LengthAwarePaginator|ResourceCollection
    {
        return $this->mainModel::query()->paginate($this->itemsPerPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AbstractUpdateOrCreateRequest $request
     * @return Model
     */
    public function store(array $requestData): Model
    {
        $object = new $this->mainModel;
        $object->fill($requestData);
        $object->save();
        return $object;
    }

    /**
     * Display the specified resource.
     *
     * @param Model $object
     * @return Model
     */
    public function show(Model $object): Model
    {
        return $object;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AbstractUpdateOrCreateRequest $request
     * @param Model $object
     * @return Model
     */
    public function update(AbstractUpdateOrCreateRequest $request, Model $object): Model
    {
        $object->fill($request->all());
        $object->save();
        return $object;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $object
     * @return bool
     */

    public function destroy(Model $object): bool
    {
        return $object->delete();
    }
}
