<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The posts that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_posts', 'category_id', 'post_id');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }  

    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = lcfirst($slug);
    }  
}
