<?php

namespace App\Services\ChecklistGroupService;

use App\Models\Checklist;

class ChecklistGroupService
{
    public function allData($checklist)
    {
        $result = Checklist::where('checklist_group_id', $checklist->checklist_group_id)
            ->whereNull('user_id')
            ->withCount(['tasks' => function ($query) {
                $query->whereNull('user_id');
            },])
            ->withCount([('user_tasks') => function ($query) {
                $query->whereNotNull('completed_at');
            }])
            ->get();

        return $result;
    }
}
