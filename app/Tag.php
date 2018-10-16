<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App
 */
class Tag extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * @return string
     */
    public function GetRouteKeyName()
    {
        return 'name';
    }
}