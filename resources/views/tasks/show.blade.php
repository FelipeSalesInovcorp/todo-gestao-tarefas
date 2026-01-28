<x-layouts::app :title="$task->title">
    <div class="max-w-3xl mx-auto py-6 space-y-4">

        <h1 class="text-2xl font-semibold">{{ $task->title }}</h1>

        <p>{{ $task->description ?: 'Sem descrição.' }}</p>

        <div class="text-sm text-gray-600">
            <p>Prioridade: {{ ucfirst($task->priority) }}</p>
            <p>Vencimento: {{ $task->due_date?->format('d/m/Y') ?? '—' }}</p>
            <p>Estado: {{ $task->is_completed ? 'Concluída' : 'Pendente' }}</p>
        </div>

        <div class="flex gap-2">
            <form method="POST" action="{{ route('tasks.toggleComplete', $task) }}">
                @csrf
                @method('PATCH')
                <button class="px-3 py-2 bg-green-600 text-white rounded">
                    {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                </button>
            </form>

            <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-2 bg-gray-700 text-white rounded">
                Editar
            </a>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                @csrf
                @method('DELETE')
                <button class="px-3 py-2 bg-red-600 text-white rounded">
                    Apagar
                </button>
            </form>
        </div>

    </div>
</x-layouts::app>