<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'subcategory_id',
        'content',
        'author_id',
        'status',
        'image',
        'description',
        'is_published',
        'published_at',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
