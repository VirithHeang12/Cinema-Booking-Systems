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
        return $user->can(PermissionEnum::VIEW_ANY_HALLTYPES) ?
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
    public function view(User $user, HallType $halltype): Response
    {
        return $user->can(PermissionEnum::VIEW_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to view this halltype.');
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
        return $user->can(PermissionEnum::CREATE_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to create halltypes.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, HallType $halltype): Response
    {
        return $user->can(PermissionEnum::UPDATE_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to update this halltype.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, HallType $halltype): Response
    {
        return $user->can(PermissionEnum::DELETE_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this halltype.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, HallType $halltype): Response
    {
        return $user->can(PermissionEnum::RESTORE_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this halltype.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\HallType  $halltype
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, HallType $halltype): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this halltype.');
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
        return $user->can(PermissionEnum::IMPORT_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to import halltypes.');
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
        return $user->can(PermissionEnum::EXPORT_HALLTYPE) ?
            Response::allow() :
            Response::deny('You do not have permission to export halltypes.');
    }
}
