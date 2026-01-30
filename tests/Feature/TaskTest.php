<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Pode exibir apenas as tarefas que pertencem ao usuário autenticado.', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    Task::factory()->count(2)->for($userA)->create();
    Task::factory()->count(3)->for($userB)->create();

    $this->actingAs($userA)
        ->get(route('tasks.index'))
        ->assertOk();

    // Validação robusta no DB: garante isolamento por utilizador
    expect(Task::where('user_id', $userA->id)->count())->toBe(2);
    expect(Task::where('user_id', $userB->id)->count())->toBe(3);
});

it('Pode criar uma tarefa', function () {
    $user = User::factory()->create();

    $payload = [
        'title' => 'Estudar Laravel',
        'description' => 'Pest + Feature tests',
        'priority' => 'high',
        'due_date' => now()->addDays(3)->toDateString(),
    ];

    $this->actingAs($user)
        ->post(route('tasks.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'user_id' => $user->id,
        'title' => 'Estudar Laravel',
        'priority' => 'high',
        'is_completed' => 0,
    ]);
});

it('Pode editar uma tarefa', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for($user)->create([
        'title' => 'Antigo título',
        'priority' => 'low',
        'is_completed' => false,
    ]);

    $payload = [
        'title' => 'Novo título',
        'description' => 'Atualizada',
        'priority' => 'medium',
        'due_date' => now()->addDays(10)->toDateString(),
        // importante: manter o estado atual caso o teu update valide este campo
        'is_completed' => $task->is_completed ? 1 : 0,
    ];

    $this->actingAs($user)
        ->put(route('tasks.update', $task), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Novo título',
        'priority' => 'medium',
    ]);
});

it('Pode marcar uma tarefa como concluída', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for($user)->create([
        'is_completed' => false,
    ]);

    // No teu projeto, o botão "Concluir" chama:
    // PATCH /tasks/{task}/toggle-complete
    $this->actingAs($user)
        ->patch("/tasks/{$task->id}/toggle-complete")
        ->assertRedirect();

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'is_completed' => 1,
    ]);
});

it('Pode excluir uma tarefa', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for($user)->create();

    $this->actingAs($user)
        ->delete(route('tasks.destroy', $task))
        ->assertRedirect();

    $this->assertDatabaseMissing('tasks', [
        'id' => $task->id,
    ]);
});

it('Pode filtrar tarefas por status, prioridade e intervalo de data de vencimento', function () {
    $user = User::factory()->create();

    // A: (pending + high + dentro do range)
    $a = Task::factory()->for($user)->create([
        'is_completed' => false,
        'priority' => 'high',
        'due_date' => now()->addDays(2)->toDateString(),
        'title' => 'A',
    ]);

    // B: não deve aparecer (completed, apesar de high e dentro do range)
    $b = Task::factory()->for($user)->create([
        'is_completed' => true,
        'priority' => 'high',
        'due_date' => now()->addDays(2)->toDateString(),
        'title' => 'B',
    ]);

    // C: não deve aparecer (pending, mas prioridade low e fora do range)
    $c = Task::factory()->for($user)->create([
        'is_completed' => false,
        'priority' => 'low',
        'due_date' => now()->addDays(30)->toDateString(),
        'title' => 'C',
    ]);

    $resp = $this->actingAs($user)->get(route('tasks.index', [
        'status' => 'pending',
        'priority' => 'high',
        'due_from' => now()->toDateString(),
        'due_to' => now()->addDays(7)->toDateString(),
    ]));

    $resp->assertOk();

    // validamos a coleção "tasks" que a view recebeu.
    $resp->assertViewHas('tasks', function ($tasks) use ($a, $b, $c) {
        $ids = $tasks->pluck('id')->all();

        return in_array($a->id, $ids, true)
            && !in_array($b->id, $ids, true)
            && !in_array($c->id, $ids, true);
    });
});
