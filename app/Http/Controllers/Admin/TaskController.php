<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Checklist;
use App\Models\Task;
use App\Services\TaskService\TaskService;
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
        $result = (new TaskService())->setTaskComtplete($id);
        return response()->json($result);
    }

    public function completedTasks(Checklist $checklist)
    {
        $result = (new TaskService())->getCompletedTasks($checklist);

        return response()->json($result);
    }
}
