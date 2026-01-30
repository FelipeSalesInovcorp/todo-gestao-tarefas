@csrf

@php
    $inputBase = 'mt-1 block w-full rounded-md bg-white text-slate-900 placeholder-slate-400 border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
@endphp

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-slate-700">Título</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $task->title ?? '') }}"
            required
            class="{{ $inputBase }}"
            placeholder="Ex: Estudar para a apresentação"
        >
        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Descrição</label>
        <textarea
            name="description"
            rows="4"
            class="{{ $inputBase }}"
            placeholder="(Opcional) Detalhes da tarefa..."
        >{{ old('description', $task->description ?? '') }}</textarea>
        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Data de vencimento</label>
        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="{{ $inputBase }}"
        >
        @error('due_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Prioridade</label>
        <select
            name="priority"
            class="{{ $inputBase }}"
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
