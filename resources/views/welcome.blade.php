<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'To-Do') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <header class="border-b border-white/10">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="h-9 w-9 rounded-xl bg-white/10 grid place-items-center font-semibold">✓</div>
                <span class="font-semibold tracking-tight">{{ config('app.name', 'To-Do') }}</span>
            </div>

            <nav class="flex items-center gap-2">
                @auth
                <a href="{{ route('tasks.index') }}"
                    class="px-4 py-2 rounded-lg bg-indigo-500 hover:bg-indigo-400 transition text-white">
                    Ir para Tarefas
                </a>
                @else
                @if (Route::has('login'))
                <a href="{{ route('login') }}"
                    class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/15 transition">
                    Entrar
                </a>
                @endif

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded-lg bg-indigo-500 hover:bg-indigo-400 transition text-white">
                    Criar conta
                </a>
                @endif
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-14 grid lg:grid-cols-2 gap-10 items-center">
        <section class="space-y-6">
            <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight">
                Organiza as tuas tarefas <span class="text-indigo-400">sem complicação</span>.
            </h1>

            <p class="text-zinc-300 text-lg leading-relaxed">
                Cria tarefas, define prioridade e data de vencimento, e acompanha o estado
                (pendente / concluída). Tudo numa interface limpa.
            </p>

            <div class="flex flex-wrap gap-3">
                @guest
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="px-5 py-3 rounded-xl bg-indigo-500 hover:bg-indigo-400 transition text-white font-medium">
                    Começar agora
                </a>
                @endif

                @if (Route::has('login'))
                <a href="{{ route('login') }}"
                    class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/15 transition font-medium">
                    Já tenho conta
                </a>
                @endif
                @else
                <a href="{{ route('tasks.index') }}"
                    class="px-5 py-3 rounded-xl bg-indigo-500 hover:bg-indigo-400 transition text-white font-medium">
                    Ver as minhas tarefas
                </a>
                @endguest
            </div>

            <div class="grid sm:grid-cols-3 gap-3 pt-2">
                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                    <p class="font-medium">Prioridades</p>
                    <p class="text-sm text-zinc-300 mt-1">Alta, média e baixa.</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                    <p class="font-medium">Vencimento</p>
                    <p class="text-sm text-zinc-300 mt-1">Controla prazos facilmente.</p>
                </div>
                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                    <p class="font-medium">Filtros</p>
                    <p class="text-sm text-zinc-300 mt-1">Por estado e datas.</p>
                </div>
            </div>
        </section>

        <aside class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Exemplo</p>
                    <span class="text-xs px-2 py-1 rounded bg-white/10 text-zinc-200">To-Do</span>
                </div>

                <div class="space-y-3">
                    <div class="rounded-xl border border-white/10 bg-zinc-950/40 p-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="font-medium">Fechar bloco no CRM</p>
                            <p class="text-sm text-zinc-300 mt-1">Alta • vence hoje</p>
                        </div>
                        <span class="text-green-400 font-semibold">✓</span>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-zinc-950/40 p-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="font-medium">Adicionar filtros no /tasks</p>
                            <p class="text-sm text-zinc-300 mt-1">Média • vence amanhã</p>
                        </div>
                        <span class="text-zinc-400 font-semibold">•</span>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-zinc-950/40 p-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="font-medium">Gravar vídeo de apresentação</p>
                            <p class="text-sm text-zinc-300 mt-1">Baixa • sem data</p>
                        </div>
                        <span class="text-zinc-400 font-semibold">•</span>
                    </div>
                </div>

                <p class="text-xs text-zinc-400">
                    Depois do login, és redirecionado para as tuas tarefas.
                </p>
            </div>
        </aside>
    </main>

    <footer class="border-t border-white/10">
        <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-zinc-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>© {{ date('Y') }} {{ config('app.name', 'To-Do') }}</span>
            <span>Felipe Sales</span>
        </div>
    </footer>
</body>

</html>