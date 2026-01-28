<?php

namespace App\Actions\Tasks;

use App\Models\Task;

class ToggleTaskCompletionAction
{
    public function execute(Task $task): Task
    {
        $task->update([
            'is_completed' => ! $task->is_completed,
        ]);

        return $task;
    }
}
