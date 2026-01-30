<x-layouts::app :title="__('Nova tarefa')">
    <div class="max-w-3xl mx-auto py-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-white-900">Nova tarefa</h1>
            <a href="{{ route('tasks.index') }}" class="text-sm text-white-600 hover:text-red-900 hover:underline">
                Voltar
            </a>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            @include('tasks._form')

            <div class="flex justify-end gap-2 pt-2">
                <a
                    href="{{ route('tasks.index') }}"
                    class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100"
                >
                    Cancelar
                </a>

                <button
                    class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white"
                >
                    Criar
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
