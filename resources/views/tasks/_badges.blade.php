@php
    $priority = $task->priority;

    $priorityLabel = match ($priority) {
        'high' => '🔥 Alta',
        'medium' => '🟡 Média',
        'low' => '🟢 Baixa',
        default => ucfirst($priority),
    };

    $priorityClasses = match ($priority) {
        'high' => 'bg-rose-50 text-rose-700 ring-rose-200 dark:bg-rose-500/10 dark:text-rose-200 dark:ring-rose-400/20',
        'medium' => 'bg-amber-50 text-amber-800 ring-amber-200 dark:bg-amber-500/10 dark:text-amber-200 dark:ring-amber-400/20',
        'low' => 'bg-emerald-50 text-emerald-700 ring-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-200 dark:ring-emerald-400/20',
        default => 'bg-zinc-50 text-zinc-700 ring-zinc-200 dark:bg-zinc-500/10 dark:text-zinc-200 dark:ring-zinc-400/20',
    };

    $statusLabel = $task->is_completed ? 'Concluída' : 'Pendente';
    $statusClasses = $task->is_completed
        ? 'bg-emerald-50 text-emerald-700 ring-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-200 dark:ring-emerald-400/20'
        : 'bg-zinc-50 text-zinc-700 ring-zinc-200 dark:bg-zinc-500/10 dark:text-zinc-200 dark:ring-zinc-400/20';

    $dueText = $task->due_date?->format('d/m/Y');

    // vencida (se não concluída)
    $isOverdue = $task->due_date && !$task->is_completed && $task->due_date->isPast();
@endphp

<div class="flex flex-wrap items-center gap-2">
    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $priorityClasses }}">
        Prioridade: {{ $priorityLabel }}
    </span>

    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClasses }}">
        {{ $statusLabel }}
    </span>

    @if($dueText)
        <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset
            {{ $isOverdue
                ? 'bg-rose-50 text-rose-700 ring-rose-200 dark:bg-rose-500/10 dark:text-rose-200 dark:ring-rose-400/20'
                : 'bg-indigo-50 text-indigo-700 ring-indigo-200 dark:bg-indigo-500/10 dark:text-indigo-200 dark:ring-indigo-400/20' }}">
            Vence: {{ $dueText }}{{ $isOverdue ? ' (atrasada)' : '' }}
        </span>
    @else
        <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset bg-zinc-50 text-zinc-700 ring-zinc-200 dark:bg-zinc-500/10 dark:text-zinc-200 dark:ring-zinc-400/20">
            Sem vencimento
        </span>
    @endif
</div>