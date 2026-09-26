<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }


    protected $fillable =
    [

        'title',
        'body',
        'image',
        'slug',
        'category_id',
        'meta_description',
        'meta_title',
        'image_alt'



    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function comments()
{
    return $this->hasMany(Comment::class);
}



}
