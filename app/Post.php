<?php

namespace App;

use Carbon\Carbon;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() // $comment->post->user
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $body
     */
    public function addComment($body)
    {
        $this->comments()->create(compact('body'));

        // Comment::create([
           // 'body' => $body,
           // 'post_id' => $this->id
       // ]);
    }

    /**
     * @param $query
     * @param $filters
     */
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['month'])){
            if($month = $filters['month']){
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
        }

        if(isset($filters['year'])){
            if($year = $filters['year']){
                $query->whereYear('created_at', $year);
            }
        }
    }

    /**
     * @return mixed
     */
    public static function archives()
    {
        return static::selectRaw('year(created_at) year,monthname(created_at) month,count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}