<?php

namespace Database\Seeders;

use App\Models\SearchLog;
use Illuminate\Database\Seeder;

class SearchLogSeeder extends Seeder
{
    public function run(): void
    {
        // Sample search logs untuk demo/testing
        $sampleSearches = [
            ['query' => 'malin kundang', 'results_count' => 1],
            ['query' => 'sangkuriang', 'results_count' => 1],
            ['query' => 'jawa barat', 'results_count' => 3],
            ['query' => 'sumatra', 'results_count' => 2],
            ['query' => 'timun mas', 'results_count' => 1],
            ['query' => 'roro jonggrang', 'results_count' => 1],
            ['query' => 'bawang merah', 'results_count' => 1],
            ['query' => 'legenda jawa', 'results_count' => 5],
            ['query' => 'cerita rakyat', 'results_count' => 8],
            ['query' => 'dongeng nusantara', 'results_count' => 8],
            ['query' => 'danau toba', 'results_count' => 1],
            ['query' => 'lutung kasarung', 'results_count' => 1],
            ['query' => 'keong mas', 'results_count' => 1],
        ];

        foreach ($sampleSearches as $search) {
            // Simulate multiple searches
            for ($i = 0; $i < rand(2, 8); $i++) {
                SearchLog::create([
                    'query' => $search['query'],
                    'user_id' => null, // guest search
                    'results_count' => $search['results_count'],
                    'ip_address' => '127.0.0.' . rand(1, 255),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'created_at' => now()->subDays(rand(0, 30)),
                ]);
            }
        }
    }
}