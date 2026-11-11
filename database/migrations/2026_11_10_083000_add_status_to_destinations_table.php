<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('destinations') && ! Schema::hasColumn('destinations', 'status')) {
            Schema::table('destinations', function (Blueprint $table) {
                $table->string('status')->default('post')->index()->after('price');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('destinations') && Schema::hasColumn('destinations', 'status')) {
            Schema::table('destinations', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
