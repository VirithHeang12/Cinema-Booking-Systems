<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Show;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShowPolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_SHOWS)
            ? Response::allow()
            : Response::deny('You do not have permission to view shows.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::VIEW_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to view this show.');
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
        return $user->can(PermissionEnum::CREATE_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to create shows.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::UPDATE_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to update this show.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::DELETE_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this show.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::RESTORE_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this show.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this show.');
    }

    /**
     * Determine whether the user can import the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::IMPORT_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to import shows.');
    }

    /**
     * Determine whether the user can export the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Show  $show
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user, Show $show): Response
    {
        return $user->can(PermissionEnum::EXPORT_SHOW)
            ? Response::allow()
            : Response::deny('You do not have permission to export shows.');
    }
}
