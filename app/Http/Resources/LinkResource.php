<?php

namespace App\Http\Resources;

use App\Models\Link;
use DateTime;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class LinkResource extends JsonResource
{

    /** @var Link */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     * @throws Exception
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $expiresString = '';
        $expiresStringPretty = '';

        if ($this->resource->expires_at) {
            $expireDate = new DateTime($this->resource->expires_at);
            $expiresStringPretty = $expireDate->format('d.m.Y');
            $expiresString = $this->resource->expires_at;
        }

        return [
            'id' => $this->resource->id,
            'text' => $this->resource->text,
            'link' => route('get_image_by_link', ['uid' => $this->resource->text]),
            'visits_left' => $this->resource->visits_left,
            'expires_at' => $expiresString,
            'expires_at_pretty' => $expiresStringPretty,
            'image_id' => $this->resource->image->id,
            'image_name' => $this->resource->image->name,
        ];
    }
}
