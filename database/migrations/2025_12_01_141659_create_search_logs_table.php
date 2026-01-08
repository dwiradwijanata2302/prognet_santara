<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->string('query'); // keyword yang dicari
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // null jika guest
            $table->integer('results_count')->default(0); // jumlah hasil pencarian
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            // Index untuk query analytics
            $table->index('query');
            $table->index('created_at');
            $table->index(['query', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_logs');
    }
};