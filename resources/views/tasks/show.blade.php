<x-layouts::app :title="$task->title">
    <div class="relative">
        {{-- Fundo suave (claro) + suporte dark --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-24 left-1/2 h-72 w-[48rem] -translate-x-1/2 rounded-full blur-3xl
                        bg-gradient-to-r from-indigo-200/60 via-sky-200/50 to-amber-200/40
                        dark:from-indigo-500/20 dark:via-sky-500/10 dark:to-amber-500/10">
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-6">
            {{-- Top bar --}}
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 dark:text-zinc-100 truncate">
                        {{ $task->title }}
                    </h1>
                    <div class="mt-3">
                        @include('tasks._badges', ['task' => $task])
                    </div>
                </div>

                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900
                        dark:text-zinc-300 dark:hover:text-white"
                >
                    <span aria-hidden="true">←</span>
                    Voltar
                </a>
            </div>

            {{-- Conteúdo --}}
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-sm backdrop-blur
                        dark:border-zinc-700/70 dark:bg-zinc-900/60 overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-indigo-500 via-sky-500 to-amber-400"></div>

                <div class="p-5 sm:p-7 space-y-6">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800 dark:text-zinc-200">Descrição</h2>
                        <p class="mt-2 text-slate-700 whitespace-pre-line dark:text-zinc-300">
                            {{ $task->description ?: 'Sem descrição.' }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                        <!--<div class="text-xs text-slate-500 dark:text-zinc-400">
                            ID: {{ $task->id }}
                        </div>-->

                        <div class="flex flex-wrap gap-2">
                            <form method="POST" action="{{ route('tasks.toggleComplete', $task) }}">
                                @csrf
                                @method('PATCH')
                                <button
                                    class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white
                                        shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2
                                        dark:focus:ring-offset-zinc-900"
                                >
                                    {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                                </button>
                            </form>

                            <a href="{{ route('tasks.edit', $task) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700
                                    shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                    dark:focus:ring-offset-zinc-900">
                                Editar
                            </a>

                            <form method="POST"
                                action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Tens a certeza que queres apagar esta tarefa?');">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center justify-center rounded-xl border border-rose-300 bg-rose-50 px-4 py-2.5 text-sm font-semibold text-rose-700
                                        shadow-sm hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2
                                        dark:border-rose-400/20 dark:bg-rose-500/10 dark:text-rose-200 dark:hover:bg-rose-500/20
                                        dark:focus:ring-offset-zinc-900"
                                >
                                    Apagar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>