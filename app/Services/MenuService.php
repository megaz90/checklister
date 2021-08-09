<?php

namespace App\Services;

use App\Models\Checklist;
use Carbon\Carbon;

class MenuService
{
    public function menuData()
    {
        $menu = \App\Models\ChecklistGroup::with([
            'checklists' => function ($query) {
                $query->whereNull('user_id');
            },
            'checklists.tasks' => function ($query) {
                $query->whereNull('tasks.user_id');
            },
        ])
            ->get();

        $last_action_at = auth()->user()->last_action_at;
        if (is_null($last_action_at)) {
            $last_action_at = now()->subYear(20);
        }

        $checklist_updated = Checklist::where('user_id', auth()->user()->id)->get();

        $groups = [];
        foreach ($menu->toArray() as $group) {
            if (count($group['checklists']) > 0) {
                $group_updated_at = $checklist_updated->where('checklist_group_id', $group['id'])->max('updated_at');

                $group['is_new'] = Carbon::create($group['created_at'])->greaterThan($group_updated_at);
                $group['is_updated'] = !($group['is_new']) && Carbon::create($group['updated_at'])->greaterThan($group_updated_at);
                foreach ($group['checklists'] as &$checklist) {
                    $checklist_updated_at = $checklist_updated->where('checklist_id', $checklist['id'])->max('updated_at');

                    $checklist['is_new'] = !($group['is_new']) && Carbon::create($checklist['created_at'])->greaterThan($checklist_updated_at);
                    $checklist['is_updated'] = !($group['is_new']) && !($group['is_updated']) && !($checklist['is_new']) && Carbon::create($checklist['updated_at'])->greaterThan($checklist_updated_at);
                    $checklist['tasks_count'] = count($checklist['tasks']);
                    $checklist['completed_tasks_count'] = 0;
                }
                $groups[] = $group;
            }
        }
        return [
            'admin_menu' => $groups,
            'user_menu' => $menu
        ];
    }
}
