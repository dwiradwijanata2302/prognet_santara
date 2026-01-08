<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Buat tabel regions
        if (!Schema::hasTable('regions')) {
            Schema::create('regions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('code', 10)->unique();
                $table->timestamps();
            });
        }

        // Tambah kolom region_id di stories
        Schema::table('stories', function (Blueprint $table) {
            if (!Schema::hasColumn('stories', 'region_id')) {
                $table->foreignId('region_id')->nullable()->after('slug')->constrained()->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            if (Schema::hasColumn('stories', 'region_id')) {
                $table->dropForeign(['region_id']);
                $table->dropColumn('region_id');
            }
        });

        Schema::dropIfExists('regions');
    }
};
