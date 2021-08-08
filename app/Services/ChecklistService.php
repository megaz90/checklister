<?php

namespace App\Services;

use App\Models\Checklist;

class ChecklistService
{
    public function sync_checklist(Checklist $checklist, int $id)
    {
        $checklist = Checklist::firstOrCreate(
            [
                'user_id' => $id,
                'checklist_id' => $checklist->id
            ],
            [
                'name' => $checklist->name,
                'checklist_group_id' => $checklist->checklist_group_id,
            ]
        );

        $checklist->touch();

        return $checklist
    }
}
