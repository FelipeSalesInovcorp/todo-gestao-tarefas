<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'To-Do') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-zinc-950 dark:text-zinc-100">
    <div class="relative">
        {{-- Fundo suave (igual ao look das outras views) --}}
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-24 left-1/2 h-72 w-[48rem] -translate-x-1/2 rounded-full blur-3xl
                        bg-gradient-to-r from-indigo-200/70 via-sky-200/60 to-amber-200/50
                        dark:from-indigo-500/20 dark:via-sky-500/10 dark:to-amber-500/10">
            </div>
        </div>

        {{-- Header --}}
        <header class="border-b border-slate-200/70 bg-white/60 backdrop-blur dark:border-zinc-800/70 dark:bg-zinc-950/40">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <!--<div class="h-9 w-9 rounded-xl bg-indigo-600/10 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-200 grid place-items-center font-semibold">
                        ✓
                    </div>-->

                    <div class="flex items-center gap-2">
                        <div
                            class="h-9 w-9 rounded-xl bg-white/70 p-1.5 shadow-sm ring-1 ring-slate-200
                            dark:bg-zinc-900/60 dark:ring-zinc-800">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="{{ config('app.name', 'To-Do') }} logo"
                                class="h-full w-full object-contain">
                        </div>

                        <span class="font-semibold tracking-tight">
                            <!--{{ config('app.name', 'To-Do') }}--> Gestão de Tarefas
                        </span>
                    </div>

                </div>

                <nav class="flex items-center gap-2">
                    @auth
                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white
                                shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                dark:focus:ring-offset-zinc-950">
                        Ir para Tarefas
                    </a>
                    @else
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700
                                    shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                    dark:focus:ring-offset-zinc-950">
                        Entrar
                    </a>
                    @endif

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white
                                    shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:focus:ring-offset-zinc-950">
                        Criar conta
                    </a>
                    @endif
                    @endauth
                </nav>
            </div>
        </header>

        {{-- Main --}}
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 grid lg:grid-cols-2 gap-10 items-center">
            {{-- Hero --}}
            <section class="space-y-6">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-medium text-slate-700
                            dark:border-zinc-800 dark:bg-zinc-900/60 dark:text-zinc-200">
                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                    Gestão simples de tarefas
                </div>

                <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight">
                    Organiza as tuas tarefas
                    <span class="bg-gradient-to-r from-indigo-600 to-sky-600 bg-clip-text text-transparent">
                        sem complicação
                    </span>.
                </h1>

                <p class="text-slate-600 text-lg leading-relaxed dark:text-zinc-300">
                    Cria tarefas, define prioridade e data de vencimento, e acompanha o estado (pendente / concluída).
                    Tudo numa interface consistente e fácil de usar.
                </p>

                <div class="flex flex-wrap gap-3">
                    @guest
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white
                                      shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                      dark:focus:ring-offset-zinc-950">
                        Começar agora
                    </a>
                    @endif

                    @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700
                                      shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                      dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                      dark:focus:ring-offset-zinc-950">
                        Já tenho conta
                    </a>
                    @endif
                    @else
                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white
                                  shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                  dark:focus:ring-offset-zinc-950">
                        Ver as minhas tarefas
                    </a>
                    @endguest
                </div>

                <div class="grid sm:grid-cols-3 gap-3 pt-2">
                    <div class="rounded-2xl border border-slate-200/70 bg-white/80 p-4 shadow-sm backdrop-blur
                                dark:border-zinc-800/70 dark:bg-zinc-900/60">
                        <p class="font-semibold">Prioridades</p>
                        <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">Alta, média e baixa.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200/70 bg-white/80 p-4 shadow-sm backdrop-blur
                                dark:border-zinc-800/70 dark:bg-zinc-900/60">
                        <p class="font-semibold">Vencimento</p>
                        <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">Controla prazos facilmente.</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200/70 bg-white/80 p-4 shadow-sm backdrop-blur
                                dark:border-zinc-800/70 dark:bg-zinc-900/60">
                        <p class="font-semibold">Filtros</p>
                        <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">Estado e datas.</p>
                    </div>
                </div>
            </section>

            {{-- Preview card (mesma linguagem das outras views) --}}
            <aside class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-sm backdrop-blur
                          dark:border-zinc-800/70 dark:bg-zinc-900/60 overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-indigo-500 via-sky-500 to-amber-400"></div>

                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Exemplo de tarefas</p>
                        <span class="text-xs px-2 py-1 rounded-lg bg-slate-100 text-slate-700
                                     dark:bg-zinc-800 dark:text-zinc-200">
                            {{ config('app.name', 'To-Do') }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        <div class="rounded-2xl border border-slate-200/70 bg-white p-4 flex items-start justify-between gap-3
                                    dark:border-zinc-800 dark:bg-zinc-950/30">
                            <div class="min-w-0">
                                <p class="font-semibold truncate">Fechar bloco no CRM</p>
                                <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">
                                    <span class="font-medium text-red-700 dark:text-red-300">Alta</span> • vence hoje
                                </p>
                            </div>
                            <span class="shrink-0 inline-flex items-center justify-center h-8 w-8 rounded-xl bg-emerald-500/10 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-200 font-bold">
                                ✓
                            </span>
                        </div>

                        <div class="rounded-2xl border border-slate-200/70 bg-white p-4 flex items-start justify-between gap-3
                                    dark:border-zinc-800 dark:bg-zinc-950/30">
                            <div class="min-w-0">
                                <p class="font-semibold truncate">Adicionar filtros no /tasks</p>
                                <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">
                                    <span class="font-medium text-amber-700 dark:text-amber-300">Média</span> • vence amanhã
                                </p>
                            </div>
                            <span class="shrink-0 inline-flex items-center justify-center h-8 w-8 rounded-xl bg-slate-100 text-slate-600 dark:bg-zinc-800 dark:text-zinc-300 font-bold">
                                •
                            </span>
                        </div>

                        <div class="rounded-2xl border border-slate-200/70 bg-white p-4 flex items-start justify-between gap-3
                                    dark:border-zinc-800 dark:bg-zinc-950/30">
                            <div class="min-w-0">
                                <p class="font-semibold truncate">Gravar vídeo de apresentação</p>
                                <p class="text-sm text-slate-600 mt-1 dark:text-zinc-300">
                                    <span class="font-medium text-sky-700 dark:text-sky-300">Baixa</span> • sem data
                                </p>
                            </div>
                            <span class="shrink-0 inline-flex items-center justify-center h-8 w-8 rounded-xl bg-slate-100 text-slate-600 dark:bg-zinc-800 dark:text-zinc-300 font-bold">
                                •
                            </span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-zinc-400">
                        Depois do login, és redirecionado para as tuas tarefas.
                    </p>
                </div>
            </aside>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200/70 bg-white/40 backdrop-blur dark:border-zinc-800/70 dark:bg-zinc-950/30">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-slate-500 dark:text-zinc-400
                        flex flex-col sm:flex-row items-center justify-between gap-2">
                <span>© {{ date('Y') }} {{ config('app.name', 'To-Do') }}</span>
                <span>Felipe Sales</span>
            </div>
        </footer>
    </div>
</body>

</html>