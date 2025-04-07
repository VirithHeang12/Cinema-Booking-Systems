<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\HallType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HallTypePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_HALL_TYPES) ?
            Response::allow() :
            Response::deny('You do not have permission to view halltypes.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, HallType $hallType): Response
    {
        return $user->can(PermissionEnum::VIEW_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to view this hall type.');
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
        return $user->can(PermissionEnum::CREATE_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to create hall types.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $hallType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, HallType $hallType): Response
    {
        return $user->can(PermissionEnum::UPDATE_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to update this hall type.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $hallType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, HallType $hallType): Response
    {
        return $user->can(PermissionEnum::DELETE_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this hall type.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $hallType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, HallType $hallType): Response
    {
        return $user->can(PermissionEnum::RESTORE_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this hall type.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $hallType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, HallType $hallType): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this hall type.');
    }

    /**
     * Determine whether the user can import models
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user): Response
    {
        return $user->can(PermissionEnum::IMPORT_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to import hall types.');
    }

    /**
     * Determine whether the user can export models
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user): Response
    {
        return $user->can(PermissionEnum::EXPORT_HALL_TYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to export hall types.');
    }
}
