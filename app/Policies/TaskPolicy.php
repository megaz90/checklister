<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy extends AuthorizationService
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($task)
    {
        $data = $this->check($task, "task_access");
        return $data == true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($task)
    {
        $data = $this->check($task, "task_show");
        return $data == true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($task)
    {
        $data = $this->check($task, "task_create");
        return $data == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($task)
    {
        $data = $this->check($task, "task_edit");
        return $data == true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($task)
    {
        $data = $this->check($task, "task_delete");
        return $data == true;
    }
}
