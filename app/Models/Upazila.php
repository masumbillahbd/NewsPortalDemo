<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class Upazila extends Model
{
    use HasFactory;
    
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
