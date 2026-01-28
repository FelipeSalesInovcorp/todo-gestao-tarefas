<x-layouts::app :title="__('Editar tarefa')">
    <div class="max-w-3xl mx-auto py-6">

        <h1 class="text-2xl font-semibold mb-6">Editar tarefa</h1>

        <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6 bg-white p-6 rounded shadow">
            @method('PUT')
            @include('tasks._form')

            <div class="flex justify-end gap-2">
                <a href="{{ route('tasks.show', $task) }}" class="px-4 py-2 border rounded">Cancelar</a>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">Atualizar</button>
            </div>
        </form>

    </div>
</x-layouts::app>