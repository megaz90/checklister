<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistGroupRequest;
use App\Http\Requests\UpdateChecklistGroupRequest;
use App\Models\ChecklistGroup;
use Illuminate\Http\Request;

class ChecklistGroupController extends Controller
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
        return view('admin.checklist_group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\StoreChecklistGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChecklistGroupRequest $request)
    {
        ChecklistGroup::create($request->validated());
        return redirect()->route('welcome');
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
    public function edit(ChecklistGroup $checklistGroup)
    {
        return view('admin.checklist_group.edit', compact('checklistGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChecklistGroupRequest $request, ChecklistGroup $checklistGroup)
    {
        $checklistGroup->update($request->validated());
        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChecklistGroup $checklistGroup)
    {
        $checklistGroup->delete();
        return redirect()->route('welcome');
    }
}
