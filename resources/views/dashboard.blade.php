<x-layouts::app :title="__('Dashboard')">
    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    Visão geral das suas tarefas e produtividade.
                </p>
            </div>

            {{-- Top cards --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-300">Pendentes</p>
                        <span class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                            agora
                        </span>
                    </div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $pendingCount }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tarefas por concluir</p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-300">Concluídas</p>
                        <span class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                            total
                        </span>
                    </div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $completedCount }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">No histórico</p>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-300">Vencem em 7 dias</p>
                        <span class="rounded-full bg-gray-100 px-2 py-1 text-xs text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                            próximos
                        </span>
                    </div>
                    <p class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $dueNext7Count }}</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Atenção a prazos</p>
                </div>
            </div>

            {{-- Main grid --}}
            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                {{-- Left: lists --}}
                <div class="md:col-span-2 space-y-4">
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Próximas tarefas</h2>
                            <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Ver todas
                            </a>
                        </div>

                        <div class="mt-4 divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse ($upcomingTasks as $task)
                            <a href="{{ route('tasks.show', $task) }}" class="block py-3 hover:bg-gray-50 dark:hover:bg-gray-800/40 rounded-lg px-2">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="truncate font-medium text-gray-900 dark:text-gray-100">
                                            {{ $task->title }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            Prioridade:
                                            <span class="font-medium">
                                                {{ strtoupper($task->priority) }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="shrink-0 text-right">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ optional($task->due_date)->format('d/m/Y') }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">vencimento</p>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <p class="py-6 text-sm text-gray-600 dark:text-gray-300">
                                Sem tarefas com vencimento próximo 🎉
                            </p>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Atrasadas</h2>

                        <div class="mt-4 divide-y divide-gray-200 dark:divide-gray-800">
                            @forelse ($overdueTasks as $task)
                            <a href="{{ route('tasks.show', $task) }}" class="block py-3 hover:bg-gray-50 dark:hover:bg-gray-800/40 rounded-lg px-2">
                                <div class="flex items-center justify-between gap-4">
                                    <p class="truncate font-medium text-gray-900 dark:text-gray-100">
                                        {{ $task->title }}
                                    </p>
                                    <span class="shrink-0 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700 dark:bg-red-900/30 dark:text-red-200">
                                        {{ optional($task->due_date)->format('d/m/Y') }}
                                    </span>
                                </div>
                            </a>
                            @empty
                            <p class="py-6 text-sm text-gray-600 dark:text-gray-300">
                                Sem tarefas atrasadas 🙌
                            </p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right: gauge card --}}
                <div class="md:col-span-1">
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                        <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Produtividade do mês</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                            Concluídas: {{ $monthCompleted }} / {{ $monthTotal }}
                        </p>

                        @php
                        // Gauge simples com SVG (sem libs)
                        $percent = max(0, min(100, (int) $monthCompletionRate));
                        $radius = 70;
                        $circ = 2 * 3.14159 * $radius;
                        $dash = ($percent / 100) * $circ;
                        @endphp

                        <div class="mt-6 flex items-center justify-center">
                            <div class="relative h-48 w-48">
                                <svg viewBox="0 0 200 200" class="h-48 w-48 -rotate-90">
                                    <circle cx="100" cy="100" r="{{ $radius }}"
                                        class="text-gray-200 dark:text-gray-800"
                                        stroke="currentColor" stroke-width="18" fill="transparent" />
                                    <circle cx="100" cy="100" r="{{ $radius }}"
                                        class="text-indigo-600"
                                        stroke="currentColor" stroke-width="18" fill="transparent"
                                        stroke-linecap="round"
                                        stroke-dasharray="{{ $dash }} {{ $circ - $dash }}" />
                                </svg>

                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <div class="text-4xl font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $percent }}%
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        taxa no mês
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('tasks.create') }}"
                                class="w-full rounded-md bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-500">
                                Nova tarefa
                            </a>
                            <a href="{{ route('tasks.index') }}"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-center text-sm font-semibold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800/40">
                                Ver tarefas
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts::app>

{{-- Fim do arquivo dashboard.blade.php --}}