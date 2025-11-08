<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'nickname',
        'bio',
        'profile_image',
        'cover_image',
        'specialty',
        'social_media',
        'instagram_followers',
        'tiktok_followers',
        'youtube_subscribers',
        'email',
        'phone',
        'location',
        'is_featured',
        'is_active',
        'views_count',
    ];

    protected $casts = [
        'social_media' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($influencer) {
            if (empty($influencer->slug)) {
                $influencer->slug = Str::slug($influencer->name);
            }
        });
    }

    public function getTotalFollowersAttribute()
    {
        return $this->instagram_followers + $this->tiktok_followers + $this->youtube_subscribers;
    }
}
