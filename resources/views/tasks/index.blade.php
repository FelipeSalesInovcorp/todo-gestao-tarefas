<x-layouts::app :title="__('Tarefas')">
    <div class="relative">
        {{-- Fundo suave (claro) + suporte dark --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute -top-24 left-1/2 h-72 w-[56rem] -translate-x-1/2 rounded-full blur-3xl
                        bg-gradient-to-r from-indigo-200/60 via-sky-200/50 to-amber-200/40
                        dark:from-indigo-500/20 dark:via-sky-500/10 dark:to-amber-500/10"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-6">
            {{-- Top bar --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 dark:text-zinc-100">
                        Tarefas
                    </h1>
                    <p class="mt-1 text-sm text-slate-600 dark:text-zinc-300">
                        Filtra, organiza e acompanha o progresso num só lugar.
                    </p>
                </div>

                <a
                    href="{{ route('tasks.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                        shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                        dark:focus:ring-offset-zinc-900">
                    Nova tarefa
                </a>
            </div>

            {{-- Mensagem de sucesso --}}
            @if (session('success'))
            <div class="rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-900
                            dark:border-emerald-400/20 dark:bg-emerald-500/10 dark:text-emerald-100">
                {{ session('success') }}
            </div>
            @endif

            {{-- Filtros --}}
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-sm backdrop-blur
                        dark:border-zinc-700/70 dark:bg-zinc-900/60">
                <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-indigo-500 via-sky-500 to-amber-400"></div>

                <form method="GET" action="{{ route('tasks.index') }}" class="p-5 sm:p-7 space-y-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                        @php
                        $selectBase = 'mt-1 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-slate-900 shadow-sm ' .
                        'focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 ' .
                        'dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100';
                        $labelBase = 'block text-sm font-semibold text-slate-800 dark:text-zinc-200';
                        @endphp

                        {{-- Estado --}}
                        <div>
                            <label for="status" class="{{ $labelBase }}">Estado</label>
                            <select id="status" name="status" class="{{ $selectBase }}">
                                <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>Todas</option>
                                <option value="pending" {{ ($filters['status'] ?? 'all') === 'pending' ? 'selected' : '' }}>Pendentes</option>
                                <option value="completed" {{ ($filters['status'] ?? 'all') === 'completed' ? 'selected' : '' }}>Concluídas</option>
                            </select>
                        </div>

                        {{-- Prioridade --}}
                        <div>
                            <label for="priority" class="{{ $labelBase }}">Prioridade</label>
                            <select id="priority" name="priority" class="{{ $selectBase }}">
                                <option value="all" {{ ($filters['priority'] ?? 'all') === 'all' ? 'selected' : '' }}>Todas</option>
                                <option value="high" {{ ($filters['priority'] ?? 'all') === 'high' ? 'selected' : '' }}>Alta</option>
                                <option value="medium" {{ ($filters['priority'] ?? 'all') === 'medium' ? 'selected' : '' }}>Média</option>
                                <option value="low" {{ ($filters['priority'] ?? 'all') === 'low' ? 'selected' : '' }}>Baixa</option>
                            </select>
                        </div>

                        {{-- De (due_from) --}}
                        <div>
                            <label for="due_from" class="{{ $labelBase }}">Vencimento (de)</label>
                            <input id="due_from" name="due_from" type="date"
                                value="{{ $filters['due_from'] ?? '' }}"
                                class="{{ $selectBase }}" />
                        </div>

                        {{-- Até (due_to) --}}
                        <div>
                            <label for="due_to" class="{{ $labelBase }}">Vencimento (até)</label>
                            <input id="due_to" name="due_to" type="date"
                                value="{{ $filters['due_to'] ?? '' }}"
                                class="{{ $selectBase }}" />
                        </div>

                        {{-- Ações --}}
                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                                        shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                        dark:focus:ring-offset-zinc-900">
                                Aplicar
                            </button>

                            <a href="{{ route('tasks.index') }}"
                                class="inline-flex w-full items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700
                                    shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                    dark:focus:ring-offset-zinc-900">
                                Limpar
                            </a>
                        </div>
                    </div>

                    {{-- “chips” com filtros ativos --}}
                    @php
                    $status = $filters['status'] ?? 'all';
                    $priority = $filters['priority'] ?? 'all';
                    $dueFrom = $filters['due_from'] ?? null;
                    $dueTo = $filters['due_to'] ?? null;

                    $chips = [];
                    if ($status !== 'all') $chips[] = 'Estado: ' . ($status === 'pending' ? 'Pendentes' : 'Concluídas');
                    if ($priority !== 'all') $chips[] = 'Prioridade: ' . ['high'=>'Alta','medium'=>'Média','low'=>'Baixa'][$priority];
                    if ($dueFrom) $chips[] = 'De: ' . $dueFrom;
                    if ($dueTo) $chips[] = 'Até: ' . $dueTo;
                    @endphp

                    @if (!empty($chips))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($chips as $chip)
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700
                                            dark:bg-zinc-800 dark:text-zinc-200">
                            {{ $chip }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </form>
            </div>

            {{-- Lista --}}
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 shadow-sm backdrop-blur
                        dark:border-zinc-700/70 dark:bg-zinc-900/60 overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-indigo-500 via-sky-500 to-amber-400"></div>

                @forelse ($tasks as $task)
                <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4
                                border-t border-slate-200/70 first:border-t-0 dark:border-zinc-700/70">

                    <div class="min-w-0">
                        <a href="{{ route('tasks.show', $task) }}" class="block group">
                            <p class="font-semibold text-slate-900 truncate group-hover:text-indigo-700 dark:text-zinc-100 dark:group-hover:text-indigo-300">
                                {{ $task->title }}
                            </p>

                            @if($task->description)
                            <p class="text-sm text-slate-600 mt-1 line-clamp-2 dark:text-zinc-300">
                                {{ $task->description }}
                            </p>
                            @endif
                        </a>

                        <div class="mt-3">
                            @include('tasks._badges', ['task' => $task])
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <form method="POST" action="{{ route('tasks.toggleComplete', $task) }}">
                            @csrf
                            @method('PATCH')

                            <button
                                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700
                                        shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                        dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                        dark:focus:ring-offset-zinc-900">
                                {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                            </button>
                        </form>

                        <a href="{{ route('tasks.edit', $task) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700
                                    shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                    dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800
                                    dark:focus:ring-offset-zinc-900">
                            Editar
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-700
                                    dark:bg-indigo-500/10 dark:text-indigo-200">
                        <span aria-hidden="true">✓</span>
                    </div>
                    <p class="mt-4 text-slate-900 font-semibold dark:text-zinc-100">Ainda não tens tarefas.</p>
                    <p class="mt-1 text-sm text-slate-600 dark:text-zinc-300">Cria a tua primeira tarefa para começar.</p>

                    <a href="{{ route('tasks.create') }}"
                        class="inline-flex mt-5 items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                                shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                dark:focus:ring-offset-zinc-900">
                        Criar tarefa
                    </a>
                </div>
                @endforelse
            </div>

            <div class="[&_.pagination]:justify-center">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>