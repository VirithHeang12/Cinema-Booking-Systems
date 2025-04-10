<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HallPolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewAny(User $user): Response
    {
        return $user->can(PermissionEnum::VIEW_ANY_HALLS)
            ? Response::allow()
            : Response::deny('You do not have permission to view any halls.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Hall $hall): Response
    {
        return $user->can(PermissionEnum::VIEW_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to view this hall.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(User $user): Response
    {
        return $user->can(PermissionEnum::CREATE_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to create halls.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Hall $hall): Response
    {
        return $user->can(PermissionEnum::UPDATE_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to update this hall.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Hall $hall): Response
    {
        return $user->can(PermissionEnum::DELETE_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this hall.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Hall $hall): Response
    {
        return $user->can(PermissionEnum::RESTORE_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this hall.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hall  $hall
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Hall $hall): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this hall.');
    }

    /**
     * Determine whether the user can import the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user): Response
    {
        return $user->can(PermissionEnum::IMPORT_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to import halls.');
    }

    /**
     * Determine whether the user can export the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user): Response
    {
        return $user->can(PermissionEnum::EXPORT_HALL)
            ? Response::allow()
            : Response::deny('You do not have permission to export halls.');
    }
}
