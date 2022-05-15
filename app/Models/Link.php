<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'visits_left',
        'expires_at',
    ];

    /**
     * Get the image that owns the link.
     */
    public function image(): object
    {
        return $this->belongsTo(Image::class);
    }
}
