<?php

namespace App\Actions\Dashboard;

use App\Models\Task;
use Carbon\Carbon;

class GetDashboardMetricsAction
{
    public function execute(int $userId): array
    {
        $today = Carbon::today();
        $next7 = $today->copy()->addDays(7);

        $pendingCount = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->count();

        $completedCount = Task::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();

        $dueNext7Count = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $today)
            ->whereDate('due_date', '<=', $next7)
            ->count();

        $monthTotal = Task::where('user_id', $userId)
            ->whereYear('created_at', $today->year)
            ->whereMonth('created_at', $today->month)
            ->count();

        $monthCompleted = Task::where('user_id', $userId)
            ->whereYear('created_at', $today->year)
            ->whereMonth('created_at', $today->month)
            ->where('is_completed', true)
            ->count();

        $monthCompletionRate = $monthTotal > 0
            ? (int) round(($monthCompleted / $monthTotal) * 100)
            : 0;

        $overdueTasks = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $today)
            ->orderBy('due_date')
            ->limit(5)
            ->get();

        $upcomingTasks = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $today)
            ->orderBy('due_date')
            ->limit(8)
            ->get();

        return [
            'pendingCount' => $pendingCount,
            'completedCount' => $completedCount,
            'dueNext7Count' => $dueNext7Count,
            'monthCompletionRate' => $monthCompletionRate,
            'monthCompleted' => $monthCompleted,
            'monthTotal' => $monthTotal,
            'overdueTasks' => $overdueTasks,
            'upcomingTasks' => $upcomingTasks,
        ];
    }
}
/*->where('id', $taskId)
            ->firstOrFail();
    }
}*/