<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            // Tambah kolom region_id
            $table->foreignId('region_id')->nullable()->after('slug')->constrained()->onDelete('cascade');
            
            // Hapus kolom region string nanti setelah data dimigrate
            // $table->dropColumn('region');
        });
    }

    public function down(): void
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn('region_id');
            // $table->string('region')->after('slug');
        });
    }
};
