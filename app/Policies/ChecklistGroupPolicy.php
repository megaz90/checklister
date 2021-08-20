<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChecklistGroupPolicy extends AuthorizationService
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\ChecklistGroup $checklist_group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($checklist_group)
    {
        $data = $this->check($checklist_group, "checklist_group_access");
        return $data == true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\ChecklistGroup $checklist_group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($checklist_group)
    {
        $data = $this->check($checklist_group, "checklist_group_show");
        return $data == true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\ChecklistGroup $checklist_group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($checklist_group)
    {
        $data = $this->check($checklist_group, "checklist_group_create");
        return $data == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\ChecklistGroup $checklist_group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($checklist_group)
    {
        $data = $this->check($checklist_group, "checklist_group_edit");
        return $data == true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\ChecklistGroup $checklist_group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($checklist_group)
    {
        $data = $this->check($checklist_group, "checklist_group_delete");
        return $data == true;
    }
}
