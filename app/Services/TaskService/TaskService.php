<?php

namespace App\Services\TaskService;

use App\Models\Task;

class TaskService
{
    public function setTaskComtplete($id)
    {
        $task = Task::find($id);
        //Replicate the collection found from "Task::find" without attribute id but fillable with id.
        if ($task) {
            $user_task = Task::where('task_id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if ($user_task) {
                if (is_null($user_task->completed_at)) {
                    $user_task->update(['completed_at' => now()]);
                }
            } else {
                $user_task = $task->replicate();
                $user_task['task_id'] = $task->id;
                $user_task['user_id'] = auth()->user()->id;
                $user_task['completed_at'] = now();
                $user_task->save();
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    public function getCompletedTasks($checklist)
    {
        $completed_tasks = Task::where('checklist_id', $checklist->id)
            ->where('user_id', auth()->user()->id)
            ->whereNotNull('completed_at')
            ->pluck('task_id')      // Getting only Task id using "pluck()"
            ->toArray();

        return $completed_tasks;
    }
}
