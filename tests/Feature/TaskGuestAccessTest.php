<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Os visitantes são redirecionados para a página de login ao tentarem acessar o índice de tarefas.', function () {
    $this->get(route('tasks.index'))
        ->assertRedirect(route('login'));
});

it('Os visitantes são redirecionados para a página de login ao tentarem criar uma tarefa.', function () {
    $this->post(route('tasks.store'), [
        'title' => 'Sem login',
        'priority' => 'low',
    ])->assertRedirect(route('login'));
});

it('Os visitantes são redirecionados para a página de login ao tentarem atualizar uma tarefa.', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $this->put(route('tasks.update', $task), [
        'title' => 'Update sem login',
        'priority' => 'medium',
    ])->assertRedirect(route('login'));
});

it('Os visitantes são redirecionados para a página de login ao tentarem marcar uma tarefa como concluída.', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(['is_completed' => false]);

    $this->patch("/tasks/{$task->id}/toggle-complete")
        ->assertRedirect(route('login'));
});

it('Os visitantes são redirecionados para a página de login ao tentarem excluir uma tarefa.', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $this->delete(route('tasks.destroy', $task))
        ->assertRedirect(route('login'));
});
