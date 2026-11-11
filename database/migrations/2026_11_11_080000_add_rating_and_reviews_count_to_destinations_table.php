<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            if (! Schema::hasColumn('destinations', 'rating')) {
                $table->decimal('rating', 3, 1)->default(0.0)->after('price');
            }
            if (! Schema::hasColumn('destinations', 'reviews_count')) {
                $table->unsignedInteger('reviews_count')->default(0)->after('rating');
            }
        });

        // Recalculate ratings and reviews_count for any existing destinations
        if (Schema::hasTable('comments') && Schema::hasTable('destinations')) {
            $destinations = DB::table('destinations')->get();
            foreach ($destinations as $dest) {
                $stats = DB::table('comments')
                    ->where(function ($q) use ($dest) {
                        $q->where('destination_id', $dest->id);
                        if (! empty($dest->name)) {
                            $slug = strtolower($dest->name);
                            $q->orWhere('destination_slug', 'like', "%{$slug}%");
                        }
                    })
                    ->where('status', 'published')
                    ->selectRaw('COUNT(*) as cnt, COALESCE(AVG(rating), 0) as avg_r')
                    ->first();

                if ($stats) {
                    DB::table('destinations')->where('id', $dest->id)->update([
                        'reviews_count' => (int) $stats->cnt,
                        'rating' => round((float) $stats->avg_r, 1),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            if (Schema::hasColumn('destinations', 'reviews_count')) {
                $table->dropColumn('reviews_count');
            }
            if (Schema::hasColumn('destinations', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }
};

