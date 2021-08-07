<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Services\ChecklistService;

class ChecklistController extends Controller
{
    public function show(Checklist $checklist)
    {
        (new ChecklistService())->sync_checklist($checklist, auth()->id());
        return view('user.checklist.show', compact('checklist'));
    }
}
