<x-layouts::app :title="__('Tarefas')">
    <div class="max-w-5xl mx-auto py-6 space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Tarefas</h1>

            <a href="{{ route('tasks.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded">
                Nova tarefa
            </a>
        </div>


        {{-- Filtros --}}
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
                {{-- Estado --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select id="status" name="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="all" {{ ($filters['status'] ?? 'all') === 'all' ? 'selected' : '' }}>Todas</option>
                        <option value="pending" {{ ($filters['status'] ?? 'all') === 'pending' ? 'selected' : '' }}>Pendentes</option>
                        <option value="completed" {{ ($filters['status'] ?? 'all') === 'completed' ? 'selected' : '' }}>Concluídas</option>
                    </select>
                </div>

                {{-- Prioridade --}}
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700">Prioridade</label>
                    <select id="priority" name="priority"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="all" {{ ($filters['priority'] ?? 'all') === 'all' ? 'selected' : '' }}>Todas</option>
                        <option value="high" {{ ($filters['priority'] ?? 'all') === 'high' ? 'selected' : '' }}>Alta</option>
                        <option value="medium" {{ ($filters['priority'] ?? 'all') === 'medium' ? 'selected' : '' }}>Média</option>
                        <option value="low" {{ ($filters['priority'] ?? 'all') === 'low' ? 'selected' : '' }}>Baixa</option>
                    </select>
                </div>

                {{-- De (due_from) --}}
                <div>
                    <label for="due_from" class="block text-sm font-medium text-gray-700">Vencimento (de)</label>
                    <input id="due_from" name="due_from" type="date"
                        value="{{ $filters['due_from'] ?? '' }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                {{-- Até (due_to) --}}
                <div>
                    <label for="due_to" class="block text-sm font-medium text-gray-700">Vencimento (até)</label>
                    <input id="due_to" name="due_to" type="date"
                        value="{{ $filters['due_to'] ?? '' }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                {{-- Ações --}}
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        Aplicar
                    </button>

                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                        Limpar
                    </a>
                </div>
            </div>

            {{-- Opcional: “chips” com filtros ativos --}}
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
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach ($chips as $chip)
                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                    {{ $chip }}
                </span>
                @endforeach
            </div>
            @endif
        </form>

        {{-- Mensagem de sucesso --}}
        @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow rounded divide-y">
            @forelse ($tasks as $task)

            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div class="min-w-0">
                    <a href="{{ route('tasks.show', $task) }}" class="block">
                        <p class="font-semibold text-gray-900 truncate">
                            {{ $task->title }}
                        </p>

                        @if($task->description)
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            {{ $task->description }}
                        </p>
                        @endif
                    </a>

                    <div class="mt-3">
                        @include('tasks._badges', ['task' => $task])
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <form method="POST"
                        action="{{ route('tasks.toggleComplete', $task) }}">
                        @csrf
                        @method('PATCH')

                        <button
                            class="px-3 py-2 rounded-lg border bg-white hover:bg-gray-50 text-sm">
                            {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}"
                        class="px-3 py-2 rounded-lg border bg-white hover:bg-gray-50 text-sm">
                        Editar
                    </a>
                </div>
            </div>

            @empty
            <div class="p-8 text-center">
                <p class="text-gray-700 font-medium">Ainda não tens tarefas.</p>
                <p class="text-gray-500 text-sm mt-1">Cria a tua primeira tarefa para começar.</p>
                <a href="{{ route('tasks.create') }}"
                    class="inline-block mt-4 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-500">
                    Criar tarefa
                </a>
            </div>
            @endforelse

        </div>

        {{ $tasks->links() }}

    </div>
</x-layouts::app>