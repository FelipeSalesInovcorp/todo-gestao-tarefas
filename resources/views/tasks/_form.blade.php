@csrf

@php
    $inputBase =
        'mt-1 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-slate-900 ' .
        'placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 ' .
        'dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder-zinc-400';
@endphp

<div class="space-y-5">
    <div>
        <label class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">Título</label>
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
        <label class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">Descrição</label>
        <textarea
            name="description"
            rows="4"
            class="{{ $inputBase }}"
            placeholder="(Opcional) Detalhes da tarefa..."
        >{{ old('description', $task->description ?? '') }}</textarea>
        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">Data de vencimento</label>
            <input
                type="date"
                name="due_date"
                value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                class="{{ $inputBase }}"
            >
            @error('due_date') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">Prioridade</label>
            <select name="priority" class="{{ $inputBase }}">
                @foreach (['high' => 'Alta 🔥', 'medium' => 'Média 🟡', 'low' => 'Baixa 🟢'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('priority', $task->priority ?? 'medium') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('priority') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
