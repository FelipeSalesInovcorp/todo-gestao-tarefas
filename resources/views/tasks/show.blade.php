<x-layouts::app :title="$task->title">
    <div class="max-w-3xl mx-auto py-6 space-y-6">

        {{-- Título --}}
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                {{ $task->title }}
            </h1>

            {{-- Badges --}}
            <div class="mt-3">
                @include('tasks._badges', ['task' => $task])
            </div>
        </div>

        {{-- Descrição em card --}}
        <div class="bg-white rounded-xl border p-5">
            <h2 class="font-semibold text-gray-900 mb-2">Descrição</h2>
            <p class="text-gray-700 whitespace-pre-line">
                {{ $task->description ?: 'Sem descrição.' }}
            </p>
        </div>

        {{-- Ações --}}
        <div class="flex flex-wrap gap-2">
            <form method="POST" action="{{ route('tasks.toggleComplete', $task) }}">
                @csrf
                @method('PATCH')
                <button
                    class="px-3 py-2 rounded bg-green-600 hover:bg-green-500 text-green-100">
                    {{ $task->is_completed ? 'Reabrir' : 'Concluir' }}
                </button>
            </form>

            <a href="{{ route('tasks.edit', $task) }}"
                class="px-3 py-2 rounded bg-gray-800 hover:bg-gray-700 text-white">
                Editar
            </a>

            <form method="POST"
                action="{{ route('tasks.destroy', $task) }}"
                onsubmit="return confirm('Tens a certeza que queres apagar esta tarefa?');">
                @csrf
                @method('DELETE')
                <button
                    class="px-3 py-2 rounded bg-red-600 hover:bg-red-500 text-white">
                    Apagar
                </button>
            </form>
        </div>

    </div>
</x-layouts::app>