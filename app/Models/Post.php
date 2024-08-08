<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\Post\{FeaturedStatus, PostStatus, PostType, PriorityStatus};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Support\Eloquent\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'posts';

    protected $guarded = [];

    protected $columnSlug = 'title';

    protected static function boot()
    {
        parent::boot();
    }

    protected $casts = [
        'status' => PostStatus::class,
        'post_type' => PostType::class,
        'is_featured' => FeaturedStatus::class,
        'priority' => PriorityStatus::class,
    ];


    public function isPublished(): bool
    {
        return $this->status == PostStatus::Published;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'posts_posts_categories', 'post_id', 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', PostStatus::Published);
    }

    public function scopeHasCategories($query, array $categoriesId)
    {
        return $query->whereHas('categories', function ($query) use ($categoriesId) {
            $query->whereIn('id', $categoriesId);
        });
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'id');
    }
}
