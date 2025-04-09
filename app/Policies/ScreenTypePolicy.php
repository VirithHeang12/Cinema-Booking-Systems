<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\ScreenType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScreenTypePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_SCREEN_TYPES)
            ? Response::allow()
            : Response::deny('You do not have permission to view any movies.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screenType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, ScreenType $screenType): Response
    {
        return $user->can(PermissionEnum::VIEW_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to view this movie.');
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
        return $user->can(PermissionEnum::CREATE_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to create movies.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screenType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, ScreenType $screenType): Response
    {
        return $user->can(PermissionEnum::UPDATE_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to update this movie.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, ScreenType $screenType): Response
    {
        return $user->can(PermissionEnum::DELETE_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this movie.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType $screenType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, ScreenType $screenType): Response
    {
        return $user->can(PermissionEnum::RESTORE_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this movie.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screenType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, ScreenType $screenType): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this movie.');
    }

    /**
     * Determine whether the user can import screen types.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user): Response
    {
        return $user->can(PermissionEnum::IMPORT_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to import movies.');
    }

    /**
     * Determine whether the user can export screen types.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user): Response
    {
        return $user->can(PermissionEnum::EXPORT_SCREEN_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to export movies.');
    }

}
