<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ListTasksAction
{
    public function execute(Request $request): LengthAwarePaginator
    {
        $query = Task::query()
            ->where('user_id', $request->user()->id);

        // status: all | pending | completed
        $status = $request->query('status', 'all');
        if ($status === 'pending') {
            $query->where('is_completed', false);
        } elseif ($status === 'completed') {
            $query->where('is_completed', true);
        }

        // priority: all | high | medium | low
        $priority = $request->query('priority', 'all');
        if (in_array($priority, ['high', 'medium', 'low'], true)) {
            $query->where('priority', $priority);
        }

        // due date range: due_from / due_to
        if ($request->filled('due_from')) {
            $query->whereDate('due_date', '>=', $request->string('due_from'));
        }
        if ($request->filled('due_to')) {
            $query->whereDate('due_date', '<=', $request->string('due_to'));
        }

        return $query
            ->orderBy('is_completed')
            ->orderByRaw('due_date is null') // datas definidas primeiro
            ->orderBy('due_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();
    }
}
