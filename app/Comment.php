<?php

namespace App;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() // $comment->user->name
    {
        return $this->belongsTo(User::class);
    }
}