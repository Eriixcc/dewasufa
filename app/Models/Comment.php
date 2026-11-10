<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'destination_id',
        'destination_slug',
        'destination_name',
        'author_name',
        'author_role',
        'rating',
        'comment',
        'photos',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'photos' => 'array',
        'rating' => 'float',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'formatted_date',
        'photo_urls',
        'avatar_text',
        'avatar_bg',
    ];

    /**
     * Get the destination that owns the comment.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Format created_at date into human friendly string.
     */
    public function getFormattedDateAttribute(): string
    {
        if (! $this->created_at) {
            return 'Baru saja';
        }

        $diffHours = $this->created_at->diffInHours();
        if ($diffHours < 1) {
            $mins = $this->created_at->diffInMinutes();

            return $mins <= 1 ? 'Baru saja' : $mins.' menit lalu';
        }
        if ($diffHours < 24) {
            return $diffHours.' jam lalu';
        }

        $diffDays = $this->created_at->diffInDays();
        if ($diffDays === 1) {
            return 'Kemarin';
        }
        if ($diffDays < 7) {
            return $diffDays.' hari lalu';
        }
        if ($diffDays < 30) {
            $weeks = max(1, (int) round($diffDays / 7));

            return $weeks.' minggu lalu';
        }

        return $this->created_at->format('d M Y');
    }

    /**
     * Get full URLs for photos.
     *
     * @return list<string>
     */
    public function getPhotoUrlsAttribute(): array
    {
        if (empty($this->photos) || ! is_array($this->photos)) {
            return [];
        }

        return array_map(function ($photo) {
            if (is_string($photo) && (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://') || str_starts_with($photo, 'data:'))) {
                return $photo;
            }

            return asset(ltrim((string) $photo, '/'));
        }, $this->photos);
    }

    /**
     * Get 1-2 letters avatar initials from author name.
     */
    public function getAvatarTextAttribute(): string
    {
        $words = preg_split('/\s+/', trim($this->author_name ?: 'Wisatawan Bali'));
        if (empty($words)) {
            return 'WB';
        }

        if (count($words) === 1) {
            return strtoupper(substr($words[0], 0, 2));
        }

        return strtoupper(substr($words[0], 0, 1).substr($words[1], 0, 1));
    }

    /**
     * Get background color for avatar.
     */
    public function getAvatarBgAttribute(): string
    {
        $palette = ['#244b2c', '#e59b2b', '#3b82f6', '#10b981', '#8b5cf6', '#ec4899', '#f97316'];
        $hash = crc32($this->author_name ?: 'Wisatawan');

        return $palette[abs($hash) % count($palette)];
    }
}
