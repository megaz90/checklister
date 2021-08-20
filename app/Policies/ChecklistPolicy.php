<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChecklistPolicy extends AuthorizationService
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Checklist $checklist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($checklist)
    {
        $data = $this->check($checklist, "checklist_access");
        return $data == true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Checklist $checklist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($checklist)
    {
        $data = $this->check($checklist, "checklist_show");
        return $data == true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Checklist $checklist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($checklist)
    {
        $data = $this->check($checklist, "checklist_create");
        return $data == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Checklist $checklist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($checklist)
    {
        $data = $this->check($checklist, "checklist_edit");
        return $data == true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Checklist $checklist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($checklist)
    {
        $data = $this->check($checklist, "checklist_delete");
        return $data == true;
    }
}
