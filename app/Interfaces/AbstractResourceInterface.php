<?php

namespace App\Interfaces;

use App\Http\Requests\AbstractUpdateOrCreateRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

interface AbstractResourceInterface
{
    public function list(Request $request);
    public function store(array $requestData);
    public function show(Model $object);
    public function update(AbstractUpdateOrCreateRequest $request, Model $object);
    public function destroy(Model $object);
}
