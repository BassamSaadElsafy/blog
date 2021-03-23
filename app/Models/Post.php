<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;


    protected $fillable = [
        'title',
        'description',
        'user_id',
        'post_img',
    ];

    public function user(){                             //
        return $this->belongsTo(User::class);           //m - one
    }

    public function human_readable_date($date)
    {
        return \Carbon\Carbon::parse($date, 'd/m/Y H:i:s')->isoFormat('ddd  Do  \of MMMM YYYY, h:mm:ss a');
    }


    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
