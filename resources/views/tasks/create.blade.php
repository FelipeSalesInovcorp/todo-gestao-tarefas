<x-layouts::app :title="__('Nova tarefa')">
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
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 dark:text-zinc-100">
                        Nova tarefa
                    </h1>
                    <p class="mt-1 text-sm text-slate-600 dark:text-zinc-300">
                        Cria uma nova tarefa e mantém o teu trabalho organizado.
                    </p>
                </div>

                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-900
                        dark:text-zinc-300 dark:hover:text-white">
                    <span aria-hidden="true">←</span>
                    Voltar
                </a>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-sm backdrop-blur
                        dark:border-zinc-700/70 dark:bg-zinc-900/60">
                {{-- Barra superior colorida --}}
                <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-indigo-500 via-sky-500 to-amber-400"></div>

                <form method="POST" action="{{ route('tasks.store') }}" class="p-5 sm:p-7 space-y-6">
                    {{--  o backend: csrf + inputs estão no partial --}}
                    @include('tasks._form')

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 pt-2">
                        <a
                            href="{{ route('tasks.index') }}"
                            class="inline-flex justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5
                                text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50
                                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                dark:focus:ring-offset-zinc-900">
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="inline-flex justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                                shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                dark:focus:ring-offset-zinc-900">
                            Criar tarefa
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-layouts::app>