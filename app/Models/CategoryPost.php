<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
