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
        if (! Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('destination_id')->nullable()->constrained('destinations')->nullOnDelete();
                $table->string('destination_slug')->nullable()->index();
                $table->string('destination_name')->nullable();
                $table->string('author_name');
                $table->string('author_role')->default('Wisatawan Terverifikasi');
                $table->decimal('rating', 3, 1)->default(5.0);
                $table->text('comment');
                $table->json('photos')->nullable();
                $table->string('status')->default('published')->index();
                $table->timestamps();
            });
        }

        // Seed initial real comments if table is empty
        if (Schema::hasTable('comments') && DB::table('comments')->count() === 0) {
            $destinations = DB::table('destinations')->get()->keyBy('id');

            $initialComments = [
                [
                    'destination_id' => isset($destinations[1]) ? 1 : null,
                    'destination_slug' => 'sekumpul',
                    'destination_name' => $destinations[1]->name ?? 'Air Terjun Sekumpul',
                    'author_name' => 'Ketut Dharmayana',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 5.0,
                    'comment' => 'Air terjun Sekumpul sangat megah dan asri! Trekking tangganya menantang tapi terbayar lunas dengan kesegaran air dan keindahan tebing hijau. Pemandu lokal sangat ramah dan sigap.',
                    'photos' => json_encode(['images/sekumpul.jpg']),
                    'status' => 'published',
                    'created_at' => now()->subHours(2),
                    'updated_at' => now()->subHours(2),
                ],
                [
                    'destination_id' => isset($destinations[1]) ? 1 : null,
                    'destination_slug' => 'sekumpul',
                    'destination_name' => $destinations[1]->name ?? 'Air Terjun Sekumpul',
                    'author_name' => 'Putu Arya Wiguna',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 5.0,
                    'comment' => 'Trek menuju lokasi cukup menantang namun terbayar lunas saat melihat hempasan air terjun yang begitu megah. Disarankan datang pagi hari saat udara masih sejuk.',
                    'photos' => null,
                    'status' => 'published',
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ],
                [
                    'destination_id' => isset($destinations[1]) ? 1 : null,
                    'destination_slug' => 'sekumpul',
                    'destination_name' => $destinations[1]->name ?? 'Air Terjun Sekumpul',
                    'author_name' => 'Sarah Wijaya',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 5.0,
                    'comment' => 'Airnya luar biasa jernih dan segar. Pemandu lokal sangat ramah dan jalur trekking tertata baik.',
                    'photos' => null,
                    'status' => 'published',
                    'created_at' => now()->subDays(7),
                    'updated_at' => now()->subDays(7),
                ],
                [
                    'destination_id' => isset($destinations[2]) ? 2 : null,
                    'destination_slug' => 'waterfall',
                    'destination_name' => $destinations[2]->name ?? 'Air Terjun Tegenungan',
                    'author_name' => 'Budi Santoso',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 5.0,
                    'comment' => 'Lokasi sangat strategis dekat Ubud. Fasilitas toilet dan kafe sekitar tertata rapi. Sangat nyaman untuk liburan keluarga.',
                    'photos' => json_encode(['images/tegenungan.jpg']),
                    'status' => 'published',
                    'created_at' => now()->subDay(),
                    'updated_at' => now()->subDay(),
                ],
                [
                    'destination_id' => isset($destinations[5]) ? 5 : (isset($destinations[6]) ? 6 : null),
                    'destination_slug' => 'sunset',
                    'destination_name' => 'Pantai Melasti & Tebing Karang',
                    'author_name' => 'Ni Made Ayu Lestari',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 4.9,
                    'comment' => 'Sunset tercantik di semenanjung Bukit Bali! Tebing kapur putihnya spektakuler, akses jalan berliku sangat estetik untuk spot foto, dan pantainya bersih terawat.',
                    'photos' => json_encode(['images/sunset-beach.jpg']),
                    'status' => 'published',
                    'created_at' => now()->subHours(5),
                    'updated_at' => now()->subHours(5),
                ],
                [
                    'destination_id' => isset($destinations[7]) ? 7 : null,
                    'destination_slug' => 'mountain',
                    'destination_name' => $destinations[7]->name ?? 'Gunung Batur',
                    'author_name' => 'Wayan Surya Putra',
                    'author_role' => 'Pendaki Terverifikasi',
                    'rating' => 4.8,
                    'comment' => 'Pendakian sunrise yang magis. Pemandangan samudera awan dari puncak sungguh luar biasa spektakuler. Pastikan membawa jaket tebal karena angin pagi cukup kencang.',
                    'photos' => json_encode(['images/batur.jpg']),
                    'status' => 'published',
                    'created_at' => now()->subDay(),
                    'updated_at' => now()->subDay(),
                ],
                [
                    'destination_id' => null,
                    'destination_slug' => 'sunrise',
                    'destination_name' => 'Pantai Sanur & Matahari Terbit',
                    'author_name' => 'I Wayan Gede',
                    'author_role' => 'Wisatawan Terverifikasi',
                    'rating' => 5.0,
                    'comment' => 'Matahari terbit di Pantai Sanur selalu menenangkan jiwa. Udara pagi segar dan banyak pilihan sarapan khas Bali di sekitar.',
                    'photos' => json_encode(['images/sunrise-beach.jpg']),
                    'status' => 'published',
                    'created_at' => now()->subDays(4),
                    'updated_at' => now()->subDays(4),
                ],
            ];

            DB::table('comments')->insert($initialComments);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
