<?php

namespace App\Models;

use Database\Factories\DestinationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /** @use HasFactory<DestinationFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinations';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'image',
        'price',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'image_url',
        'formatted_price',
        'category_slug',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'float',
        ];
    }

    /**
     * Get the resolved image URL with automatic fallback.
     */
    public function getImageUrlAttribute(): string
    {
        if (! empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }

            $cleaned = ltrim($this->image, '/');
            if (file_exists(public_path($cleaned))) {
                return asset($cleaned);
            }
        }

        $name = strtolower($this->name ?? '');
        $category = strtolower($this->category ?? '');

        if (str_contains($name, 'sekumpul')) {
            return asset('images/air terjun sekumpul.png');
        }

        if (str_contains($category, 'waterfall') || str_contains($name, 'terjun')) {
            return asset('images/waterfall.jpg');
        }

        if (str_contains($category, 'sunset') || str_contains($name, 'kuta') || str_contains($name, 'jimbaran')) {
            return asset('images/sunset-beach.jpg');
        }

        if (str_contains($category, 'sunrise') || str_contains($name, 'sanur')) {
            return asset('images/sunrise-beach.jpg');
        }

        if (str_contains($category, 'mountain') || str_contains($name, 'gunung') || str_contains($name, 'batur')) {
            return asset('images/mountain.jpg');
        }

        return asset('images/waterfall.jpg');
    }

    /**
     * Format price to Indonesian Rupiah.
     */
    public function getFormattedPriceAttribute(): string
    {
        $val = (float) ($this->price ?? 0);

        if ($val <= 0) {
            return 'Gratis';
        }

        return 'Rp '.number_format($val, 0, ',', '.').' / orang';
    }

    /**
     * Get category slug for filtering pills and JS selectors.
     */
    public function getCategorySlugAttribute(): string
    {
        $cat = strtolower($this->category ?? '');

        if (str_contains($cat, 'sunset')) {
            return 'sunset';
        }

        if (str_contains($cat, 'sunrise')) {
            return 'sunrise';
        }

        if (str_contains($cat, 'mountain') || str_contains($cat, 'gunung')) {
            return 'mountain';
        }

        return 'waterfall';
    }
}
