<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['user_id', 'slug', 'category_post_id', 'name', 'img', 'description'];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_post_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
