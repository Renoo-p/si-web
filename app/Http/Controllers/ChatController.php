<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    /**
     * 1. Menampilkan halaman utama form chat Koki AI
     */
    public function index()
    {
        // Mengikuti preferensi file kedua untuk memisahkan data session berdasarkan tab aktif
        return view('chat.index', [
            'rekomendasi' => session('active_tab') === 'bahan' ? session('ai_msg') : null,
            'bahan' => session('bahan_value')
        ]);
    }

    /**
     * 2. Memproses input ke API Groq AI
     */
    public function chat(Request $request)
    {
        // Validasi input: salah satu atau keduanya boleh diisi
        $request->validate([
            'message' => 'nullable|string',
            'bahan' => 'nullable|string',
        ]);

        $messageUser = $request->input('message');
        $bahanUser = $request->input('bahan');

        // Proteksi jika kedua input kosong
        if (!$messageUser && !$bahanUser) {
            return back()->withErrors('Mohon masukkan pertanyaan atau daftar bahan makanan.');
        }

        $apiKey = env('GROQ_API_KEY');
        // Mendeteksi tab aktif yang digunakan oleh user saat ini
        $isBahan = !empty($bahanUser);

        // MENGIKUTI PREFERENSI PERTAMA: Mempertahankan prompt kustom Anda secara utuh
        if ($isBahan) {
            $systemPrompt = 'Kamu adalah koki profesional yang ramah. Berikan 2-3 rekomendasi masakan khas Indonesia, atau dari luar beserta resep lengkap dengan rinciannya (hanya berdasarkan bahan-bahan yang disebutkan oleh user/hanya yang dimiliki user, kalau ada tambahan bumbu/bahan masakan,rekomendasikan untuk menambahkan bumbu masakan tersebut (taruhdi bawah langkah langkah di tiap resep) atau rekomendasikan masakan lain ).:  mulai dari rincian bahan(lengkap dengan jumlahnya)yang disusun secara list, serta langkah pembuatan singkatnya step by step ';
            $userContent = 'Bahan yang saya punya saat ini: ' . $bahanUser;
            $displayInput = $bahanUser;
        } else {
            $systemPrompt = 'Kamu adalah Chef Professional AI yang ramah. Jawab pertanyaan resep, tips memasak, dan trik dapur dengan detail.';
            $userContent = $messageUser;
            $displayInput = $messageUser;
        }

        try {
            // Menggunakan model 'llama-3.1-8b-instant' dengan URL endpoint openai yang benar
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userContent]
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $hasilAI = $response->json()['choices'][0]['message']['content'] ?? 'Koki AI sedang sibuk.';
                
                // Menggunakan Redirect with Session Flash agar penentuan active_tab terkunci sempurna
                return redirect()->route('chat.index')->with([
                    'user_msg' => $displayInput,
                    'ai_msg' => $hasilAI,
                    'active_tab' => $isBahan ? 'bahan' : 'chat',
                    'bahan_value' => $isBahan ? $bahanUser : null
                ]);
            }

            return back()->withErrors('Groq API Error: ' . $response->body())->withInput();

        } catch (\Exception $e) {
            return back()->withErrors('Sistem Error: ' . $e->getMessage())->withInput();
        }
    }
}