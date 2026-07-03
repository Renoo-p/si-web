<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Koki AI - Streaming & DB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>
<body class="bg-gray-100 h-screen flex flex-col">

    <header class="bg-green-600 text-white p-4 shadow-md text-center">
        <h1 class="text-2xl font-bold">🍳 Koki AI (Streaming & Database)</h1>
        <p class="text-sm opacity-80">Teks muncul real-time! Refresh halaman, chat tidak hilang.</p>
    </header>

    <main class="flex-1 overflow-y-auto p-4" id="chat-container">
        <!-- Pesan akan di-load via JS -->
    </main>

    <footer class="bg-white p-4 border-t border-gray-200">
        <form id="chat-form" class="flex gap-2 max-w-3xl mx-auto">
            <input type="text" id="user-input" placeholder="Tanya resep atau ide masakan..." 
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            <button type="submit" id="submit-btn" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Kirim
            </button>
        </form>
    </footer>


    <script>
        const form = document.getElementById('chat-form');
        const input = document.getElementById('user-input');
        const container = document.getElementById('chat-container');
        const submitBtn = document.getElementById('submit-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        let sessionId = localStorage.getItem('chat_session_id');
        let currentAiBubble = null;

        async function initChat() {
            // ... (Logika initChat tetap sama seperti sebelumnya) ...
            const res = await fetch('{{ route("chat.session") }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ session_id: sessionId })
            });
            const data = await res.json();
            sessionId = data.session_id;
            localStorage.setItem('chat_session_id', sessionId);

            container.innerHTML = '';
            if (data.history.length === 0) {
                appendMessage('Halo! Saya Koki AI. Ada bahan apa di kulkas Anda hari ini?', 'ai');
            } else {
                data.history.forEach(msg => appendMessage(msg.content, msg.role === 'user' ? 'user' : 'ai', false));
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const userMessage = input.value.trim();
            if (!userMessage) return;

            appendMessage(userMessage, 'user');
            input.value = '';
            setLoading(true);

            currentAiBubble = createMessageBubble('ai');
            container.appendChild(currentAiBubble);
            container.scrollTop = container.scrollHeight;

            try {
                const response = await fetch('{{ route("chat.stream") }}', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'text/event-stream' // PENTING
                    },
                    body: JSON.stringify({ message: userMessage, session_id: sessionId })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const reader = response.body.getReader();
                const decoder = new TextDecoder();
                let fullText = '';
                let buffer = ''; // BUFFER UNTUK MENANGANI CHUNK YANG TERPECAH

                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;

                    // Decode chunk dan tambahkan ke buffer
                    buffer += decoder.decode(value, { stream: true });
                    
                    // Pecah buffer berdasarkan pemisah SSE (\n\n)
                    const parts = buffer.split('\n\n');
                    
                    // Simpan bagian terakhir yang mungkin belum utuh ke buffer
                    buffer = parts.pop(); 

                    for (const part of parts) {
                        if (part.startsWith('data: ')) {
                            const jsonStr = part.substring(6).trim();
                            
                            if (jsonStr === '[DONE]') continue;

                            try {
                                const parsed = JSON.parse(jsonStr);
                                
                                // Cek jika ada error dari backend
                                if (parsed.error) {
                                    fullText += `\n\n[Error: ${parsed.error}]`;
                                } 
                                // Jika ada teks normal
                                else if (parsed.text) {
                                    fullText += parsed.text;
                                }
                                
                                // Update tampilan (pakai innerText dulu agar cepat, belum di-markdown)
                                currentAiBubble.innerText = fullText;
                                container.scrollTop = container.scrollHeight;
                            } catch (e) {
                                // Abaikan jika JSON belum utuh (seharusnya tidak terjadi karena kita pakai buffer)
                                console.warn('Parse error:', e);
                            }
                        }
                    }
                }

                // Streaming selesai, baru render Markdown agar rapi (list, bold, dll)
                currentAiBubble.innerHTML = marked.parse(fullText);
                container.scrollTop = container.scrollHeight;

            } catch (error) {
                console.error('Fetch Error:', error);
                currentAiBubble.innerText = 'Terjadi kesalahan koneksi. Cek console (F12) untuk detail.';
            } finally {
                setLoading(false);
                currentAiBubble = null;
            }
        });

        // ... (Fungsi appendMessage, createMessageBubble, setLoading tetap sama) ...
        
        function appendMessage(text, sender, parseMarkdown = true) {
            const wrapper = document.createElement('div');
            wrapper.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'} mb-4`;
            const bubble = document.createElement('div');
            bubble.className = `p-3 rounded-lg shadow max-w-md whitespace-pre-wrap ${sender === 'user' ? 'bg-green-500 text-white' : 'bg-white text-gray-800'}`;
            bubble.innerHTML = (sender === 'ai' && parseMarkdown) ? marked.parse(text) : text;
            wrapper.appendChild(bubble);
            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        }

        function createMessageBubble(sender) {
            const wrapper = document.createElement('div');
            wrapper.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'} mb-4`;
            const bubble = document.createElement('div');
            bubble.className = `p-3 rounded-lg shadow max-w-md whitespace-pre-wrap ${sender === 'user' ? 'bg-green-500 text-white' : 'bg-white text-gray-800'}`;
            wrapper.appendChild(bubble);
            return bubble;
        }

        function setLoading(isLoading) {
            submitBtn.disabled = isLoading;
            submitBtn.textContent = isLoading ? 'Memproses...' : 'Kirim';
            input.disabled = isLoading;
        }

        initChat();
    </script>
</body>
</html>