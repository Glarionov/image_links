<?php

namespace App\Http\Requests;

class LinkRequest extends AbstractUpdateOrCreateRequest
{
    protected array $updateRequestRules = [
        'image_id' => ['integer', 'exists:images,id'],
        'visits_left' => ['integer', 'nullable', 'max:999'],
        'expires_at' => ['date', 'nullable'],
    ];

    protected array $requiredToCreateFields = [
        'image_id'
    ];
}
