<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\Draft;
use App\Models\VideoGallery;

class Tag extends Model
{
    use HasFactory;

    protected $fillable  = ['name','slug'];

    public function posts()
    {
    return $this->belongsToMany(Post::class);
    }

    public function draft()
    {
    return $this->belongsToMany(Draft::class);
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function videoGallery()
    {
        return $this->belongsToMany(VideoGallery::class);
    }
}
