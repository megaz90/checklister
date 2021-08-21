<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request, Checklist $checklist)
    {
        $this->authorize('create', Checklist::class);

        $checklist->tasks()->create($request->validated());
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist, Task $task)
    {
        $this->authorize('update', Checklist::class);

        return view('admin.task.edit', compact('checklist', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Checklist $checklist, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist, Task $task)
    {
        $this->authorize('delete', Checklist::class);

        $task->delete();
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    public function completeTask($id)
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
                return response()->json(TRUE);
            }
        } else {
            return response()->json(FALSE);
        }
    }

    public function completedTasks(Checklist $checklist)
    {
        $completed_tasks = Task::where('checklist_id', $checklist->id)
            ->where('user_id', auth()->user()->id)
            ->whereNotNull('completed_at')
            ->pluck('task_id')      // Getting only Task id using "pluck()"
            ->toArray();

        return response()->json($completed_tasks);
    }
}
