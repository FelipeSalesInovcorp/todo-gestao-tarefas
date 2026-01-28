@csrf

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Título</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title ?? '') }}"
            required
            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Descrição</label>
        <textarea
            name="description"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >{{ old('description', $task->description ?? '') }}</textarea>
        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Data de vencimento</label>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('due_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Prioridade</label>
        <select
            name="priority"
            class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
        >
            @foreach (['high' => 'Alta', 'medium' => 'Média', 'low' => 'Baixa'] as $value => $label)
                <option value="{{ $value }}" @selected(old('priority', $task->priority ?? 'medium') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('priority') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>
</div>
