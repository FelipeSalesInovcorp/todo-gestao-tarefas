<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\ListTasksAction;
use App\Actions\Tasks\ToggleTaskCompletionAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index(Request $request, ListTasksAction $listTasks)
    {
        $tasks = $listTasks->execute($request);

        return view('tasks.index', [
            'tasks' => $tasks,
            'status' => $request->query('status', 'all'),
            'priority' => $request->query('priority', 'all'),
            'due_from' => $request->query('due_from'),
            'due_to' => $request->query('due_to'),
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request, CreateTaskAction $createTask)
    {
        $data = $this->validatedTaskData($request);

        $task = $createTask->execute($request->user(), $data);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tarefa criada com sucesso.');
    }

    public function show(Request $request, int $task)
    {
        $task = $this->findUserTask($request, $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Request $request, int $task)
    {
        $task = $this->findUserTask($request, $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, int $task, UpdateTaskAction $updateTask)
    {
        $task = $this->findUserTask($request, $task);

        $data = $this->validatedTaskData($request);

        $updateTask->execute($task, $data);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Request $request, int $task)
    {
        $task = $this->findUserTask($request, $task);
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa removida.');
    }

    public function toggleComplete(
        Request $request,
        int $task,
        ToggleTaskCompletionAction $toggle
    ) {
        $task = $this->findUserTask($request, $task);

        $toggle->execute($task);

        return back()->with('success', 'Estado da tarefa atualizado.');
    }

    private function validatedTaskData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['required', Rule::in(['high', 'medium', 'low'])],
        ]);
    }

    private function findUserTask(Request $request, int $taskId): Task
    {
        return Task::where('user_id', $request->user()->id)
            ->where('id', $taskId)
            ->firstOrFail();
    }
}

