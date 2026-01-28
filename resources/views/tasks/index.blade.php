<x-layouts::app :title="__('Tarefas')">
    <div class="max-w-5xl mx-auto py-6 space-y-6">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Tarefas</h1>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">
                Nova tarefa
            </a>
        </div>

        @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow rounded divide-y">
            @forelse ($tasks as $task)
            <div class="p-4 flex justify-between items-center">
                <div>
                    <a href="{{ route('tasks.show', $task) }}" class="font-medium">
                        {{ $task->title }}
                    </a>
                    <p class="text-sm text-gray-600">
                        {{ ucfirst($task->priority) }}
                        • {{ $task->due_date?->format('d/m/Y') ?? '—' }}
                    </p>
                </div>

                <form method="POST" action="{{ route('tasks.toggleComplete', $task) }}">
                    @csrf
                    @method('PATCH')
                    <button class="px-3 py-1 border rounded">
                        {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                    </button>
                </form>
            </div>
            @empty
            <div class="p-4 text-gray-600">Sem tarefas.</div>
            @endforelse
        </div>

        {{ $tasks->links() }}

    </div>
</x-layouts::app>