<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Models\User;

class CreateTaskAction
{
    public function execute(User $user, array $data): Task
    {
        $data['user_id'] = $user->id;
        $data['is_completed'] = false;

        return Task::create($data);
    }
}
