<x-layouts::app :title="__('Nova tarefa')">
    <div class="max-w-3xl mx-auto py-6">

        <h1 class="text-2xl font-semibold mb-6">Nova tarefa</h1>

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-6 bg-white p-6 rounded shadow">
            @include('tasks._form')

            <div class="flex justify-end gap-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded">Criar</button>
            </div>
        </form>

    </div>
</x-layouts::app>