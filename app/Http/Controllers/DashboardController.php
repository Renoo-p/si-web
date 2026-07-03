<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua resep agar muncul semua di dashboard
        $recipes = Recipe::latest()->get();
        return view('dashboard', compact('recipes'));
    }

    public function aiRecommend(Request $request)
    {
        $category = $request->query('category', 'Sehat');
        $apiKey = env('GROQ_API_KEY');
        
        if (!$apiKey) {
            return response()->json(['error' => 'API Key Groq belum diatur di file .env Anda.'], 500);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => 'Kamu adalah Koki AI ahli kuliner Indonesia. Berikan rekomendasi 1 menu masakan singkat dan list resep berdasarkan kategori yang diminta user beserta alasan singkatnya.'],
                    ['role' => 'user', 'content' => "Berikan rekomendasi makanan untuk kategori: {$category}"]
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $aiData = $response->json();
                $recommendation = $aiData['choices'][0]['message']['content'] ?? 'Gagal memformulasikan menu.';
                return response()->json(['recommendation' => $recommendation]);
            }

            return response()->json(['error' => 'Groq API bermasalah: ' . $response->body()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal terhubung ke server AI: ' . $e->getMessage()], 500);
        }
    }
}