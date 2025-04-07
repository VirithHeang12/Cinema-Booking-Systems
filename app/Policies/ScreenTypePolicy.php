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
        return $user->can(PermissionEnum::VIEW_ANY_SCREENTYPES)
            ? Response::allow()
            : Response::deny('You do not have permission to view any screen types.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screen_type
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, ScreenType $screen_type): Response
    {
        return $user->can(PermissionEnum::VIEW_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to view this screen type.');
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
        return $user->can(PermissionEnum::CREATE_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to create screen types.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screen_type
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, ScreenType $screen_type): Response
    {
        return $user->can(PermissionEnum::UPDATE_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to update this screen type.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screen_type
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, ScreenType $screen_type): Response
    {
        return $user->can(PermissionEnum::DELETE_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this screen type.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screen_type
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, ScreenType $screen_type): Response
    {
        return $user->can(PermissionEnum::RESTORE_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this screen type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ScreenType  $screen_type
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, ScreenType $screen_type): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this screen type.');
    }


    /**
     * Determine whether the user can import models.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user): Response
    {
        return $user->can(PermissionEnum::IMPORT_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to import movies.');
    }

    /**
     * Determine whether the user can export models.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user): Response
    {
        return $user->can(PermissionEnum::EXPORT_SCREENTYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to export movies.');
    }
}
