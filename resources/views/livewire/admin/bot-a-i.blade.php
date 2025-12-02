<div>
    <div x-data="{isOpen: false, questionText: ''}" @click.away="isOpen = false; if (!isOpen) questionText = ''">
        <div
            class="flex justify-between items-center gap-2 px-1 focus:ring-blue-500 text-sm w-[500px] bg-zinc-100 z-100 border border-gray-300 rounded-lg">
            <input type="text" id="question" placeholder="🤖  Chiedi ad Alyx" onkeypress.enter="handleSend()"
                x-model="questionText" autocomplete="off" @click="isOpen = !isOpen"
                class="flex-1 p-2 focus:outline-none focus:ring-0" />
            <button @click="handleSend()" x-show="isOpen"
                class="bg-zinc-400 hover:bg-zinc-600 text-white h-8 w-8 rounded-lg text-sm transition cursor-pointer">
                ➤
            </button>
        </div>
        <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-50"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-50" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed top-17 left-71 flex flex-col border border-zinc-300 overflow-hidden w-[500px] h-[500px] z-10 bg-zinc-100/80 backdrop-blur-lg shadow-lg text-sm font-medium rounded-lg">
            <div class="bg-zinc-200 text-black p-3">
                <h3 class="font-bold text-lg">🤖 Alyx</h3>
                <p class="text-zinc-500 text-xs">Powered by Gemini</p>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat">
            </div>
        </div>
    </div>
</div>


<script>
    if (typeof gestionaleMap === 'undefined') {
        window.gestionaleMap = {
        'Amministratori': {
            url: '/administrators',
            description: 'Gestisci gli amministratori del sistema'
        },
        'Logs': {
            url: '/logs',
            description: 'Visualizza i log del sistema'
        },
        'Dashboard': {
            url: '/dashboard',
            description: 'Pannello principale con statistiche'
        },
        'Residenti': {
            url: '/residents',
            description: 'Gestione residenti del gestionale'
        },
        'Impostazioni': {
            url: '/settings',
            description: 'Configurazioni generali del sistema'
        },
        'Mia Agenda': {
            url: '/diary',
            description: 'Gestione delle mie note'
        },
        'Città': {
            url: '/cities',
            description: 'Gestione delle città'
        },
        'Pagamenti': {
            url: '/payments',
            description: 'Gestione dei pagamenti'
        },
        'Archivi': {
            url: '/archive',
            description: 'Gestione dell\'archivio'
        }
    };
    }

    // Cattura il contesto della pagina
    function capturePageContext() {
        const interactiveElements = [];
        
        // Raccogli bottoni con nomi più significativi
        document.querySelectorAll('button, a[role="button"], [class*="btn"], input[type="submit"], [onclick], a[href*="/create"]').forEach(el => {
            let text = el.textContent.trim() || el.innerText.trim();
            
            // Se non ha testo visibile, guarda l'aria-label o title o attributi custom
            if (!text || text.length < 2) {
                text = el.getAttribute('aria-label') || 
                       el.getAttribute('title') || 
                       el.getAttribute('data-label') || 
                       el.getAttribute('label') ||  // Per componenti Flux
                       '';
            }
            
            // Prendi anche il valore se è un input
            if (!text && el.type === 'submit') {
                text = el.value || el.getAttribute('value') || '';
            }

            if (text && text.length > 2 && el.id !== 'sendBtn') {
                interactiveElements.push({
                    type: 'button',
                    label: text.substring(0, 50)
                });
            }
        });

        // Cerca elementi Flux con attributo label
        document.querySelectorAll('[label]').forEach(el => {
            const text = el.getAttribute('label');
            if (text && text.length > 2 && !interactiveElements.find(e => e.label === text)) {
                interactiveElements.push({
                    type: 'button',
                    label: text.substring(0, 50)
                });
            }
        });

        // Cerca elementi con attributi href che contengono "create"
        document.querySelectorAll('a[href*="create"], a[href*="new"], a[href*="add"]').forEach(el => {
            const text = el.textContent.trim();
            if (text && text.length > 2) {
                interactiveElements.push({
                    type: 'link',
                    label: text.substring(0, 50),
                    href: el.href
                });
            }
        });

        // Se ancora non trova nulla, prova a cercare link con testo
        if (interactiveElements.filter(e => e.type === 'button' || e.type === 'link').length < 5) {
            document.querySelectorAll('a').forEach(el => {
                const text = el.textContent.trim();
                if (text && text.length > 3 && !interactiveElements.find(e => e.label === text)) {
                    interactiveElements.push({
                        type: 'link',
                        label: text.substring(0, 50),
                        href: el.href
                    });
                }
            });
        }

        // Debug nel console
        /* console.log('Elementi trovati:', interactiveElements); */

        // Raccogli form
        document.querySelectorAll('form').forEach((form, idx) => {
            const inputs = Array.from(form.querySelectorAll('input, select, textarea'))
                .map(inp => ({ name: inp.name, type: inp.type, placeholder: inp.placeholder }))
                .filter(i => i.name);
            
            if (inputs.length > 0) {
                interactiveElements.push({
                    type: 'form',
                    id: form.id || `form_${idx}`,
                    fields: inputs
                });
            }
        });

        // Raccogli menu/navigazione
        document.querySelectorAll('nav a, [class*="menu"] a, [class*="sidebar"] a').forEach(el => {
            if (el.textContent.trim()) {
                interactiveElements.push({
                    type: 'navigation',
                    label: el.textContent.trim().substring(0, 50),
                    href: el.href
                });
            }
        });

        const pageTitle = document.title || document.querySelector('h1')?.textContent || 'Dashboard';

        return {
            pageTitle: pageTitle.substring(0, 100),
            url: window.location.pathname,
            elements: interactiveElements.slice(0, 15)
        };
    }
    
    async function sendPrompt(question) {
        
        
        const apiKey = "{{ config('services.alyx_api_key') }}";
        const model = 'gemini-2.5-flash-lite';
        const pageContext = capturePageContext();

        // Converti la mappa in stringa leggibile
        const mapString = Object.entries(window.gestionaleMap)
            .map(([name, info]) => `- ${name}: ${info.description} (${info.url})`)
            .join('\n');

        const context = `Sei un assistente intelligente per un gestionale Laravel. 
                            Sezioni disponibili nel gestionale:
                            ${mapString}

                            Pagina attuale: ${pageContext.pageTitle}
                            URL attuale: ${pageContext.url}

                            Elementi sulla pagina attuale:
                            ${JSON.stringify(pageContext.elements, null, 2)}

                            Quando l'utente ti chiede qualcosa:
                            1. Se si trova nella pagina corretta, suggerisci l'azione disponibile
                            2. Se deve andare in un'altra sezione, digli quale sezione visitare e come raggiungerla tramite i bottoni dalla sidebar
                            3. Sii conciso e pratico
                            4. Cita sempre il nome della sezione

                            Rispondi sempre in italiano.`;

        const url = `https://generativelanguage.googleapis.com/v1beta/models/${model}:generateContent?key=${apiKey}`;

        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                contents: [{ parts: [{ text: `${context}\n\nDomanda: ${question}` }] }],
                generationConfig: { temperature: 0.7, maxOutputTokens: 1000 }
            })
        });

        const data = await response.json();
        return data.candidates?.[0]?.content?.parts?.[0]?.text || "Errore";
    }

    function addMessage(text, type) {
        const chat = document.getElementById('chat');
        const msg = document.createElement('div');
        msg.classList.add('flex', type === 'me' ? 'justify-end' : 'justify-start');
        
        const content = document.createElement('div');
        if (type === 'me') {
            content.classList.add('px-4', 'py-2', 'rounded-lg', 'max-w-xs', 'text-sm', 'bg-blue-500', 'text-white', 'rounded-br-none');
        } else {
            content.classList.add('px-4', 'py-2', 'rounded-lg', 'max-w-xs', 'text-sm', 'bg-gray-200', 'text-gray-800', 'rounded-bl-none');
        }
        content.textContent = text;
        
        msg.appendChild(content);
        chat.appendChild(msg);
        chat.scrollTop = chat.scrollHeight;
    }

    async function handleSend() {
        const input = document.getElementById('question');
        const text = input.value.trim();
        if (!text) return;

        addMessage(text, 'me');
        input.value = '';
        input.focus();

        // Mostra loading
        const chat = document.getElementById('chat');
        const loadingMsg = document.createElement('div');
        loadingMsg.id = 'loading';
        loadingMsg.classList.add('flex', 'justify-start');
        
        const loadingContent = document.createElement('div');
        loadingContent.classList.add('bg-gray-200', 'text-gray-800', 'px-4', 'py-2', 'rounded-lg', 'rounded-bl-none', 'flex', 'items-center', 'space-x-2');
        loadingContent.innerHTML = '<div class="animate-spin h-4 w-4 border-2 border-gray-400 border-t-gray-800 rounded-full"></div><span class="text-sm">Sto pensando...</span>';
        
        loadingMsg.appendChild(loadingContent);
        chat.appendChild(loadingMsg);
        chat.scrollTop = chat.scrollHeight;

        const reply = await sendPrompt(text);
        
        // Rimuovi loading
        loadingMsg.remove();
        
        addMessage(reply, 'bot');
    }

    // Invio con Enter
    document.getElementById('question').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });

    // Messaggio iniziale
    addMessage('Ciao! Mi chiamo Alyx, sono il tuo assistente personale AI. Dimmi cosa vuoi fare o che informazione cerchi nel sistema.', 'bot');

</script>