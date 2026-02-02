@csrf

@php
    $inputBase =
        'mt-1 block w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-slate-900 ' .
        'placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 ' .
        'dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder-zinc-400';
@endphp

<div class="space-y-5">
    {{-- Título --}}
    <div>
        <label for="title" class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">
            Título
        </label>

        <input
            id="title"
            type="text"
            name="title"
            value="{{ old('title', $task->title ?? '') }}"
            required
            class="{{ $inputBase }}"
            placeholder="Ex: Estudar para a apresentação"
            aria-invalid="@error('title') true @else false @enderror"
            aria-describedby="@error('title') title_error @enderror"
        >

        @error('title')
            <p id="title_error" class="text-sm text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Descrição --}}
    <div>
        <label for="description" class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">
            Descrição
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            class="{{ $inputBase }}"
            placeholder="(Opcional) Detalhes da tarefa..."
            aria-invalid="@error('description') true @else false @enderror"
            aria-describedby="@error('description') description_error @enderror"
        >{{ old('description', $task->description ?? '') }}</textarea>

        @error('description')
            <p id="description_error" class="text-sm text-red-600 mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {{-- Data de vencimento --}}
        <div>
            <label for="due_date" class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">
                Data de vencimento
            </label>

            <input
                id="due_date"
                type="date"
                name="due_date"
                value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                class="{{ $inputBase }}"
                aria-invalid="@error('due_date') true @else false @enderror"
                aria-describedby="@error('due_date') due_date_error @enderror"
            >

            @error('due_date')
                <p id="due_date_error" class="text-sm text-red-600 mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Prioridade --}}
        <div>
            <label for="priority" class="block text-sm font-semibold text-slate-800 dark:text-zinc-200">
                Prioridade
            </label>

            <select
                id="priority"
                name="priority"
                class="{{ $inputBase }}"
                aria-invalid="@error('priority') true @else false @enderror"
                aria-describedby="@error('priority') priority_error @enderror"
            >
                @foreach (['high' => 'Alta 🔥', 'medium' => 'Média 🟡', 'low' => 'Baixa 🟢'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('priority', $task->priority ?? 'medium') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            @error('priority')
                <p id="priority_error" class="text-sm text-red-600 mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>
</div>

