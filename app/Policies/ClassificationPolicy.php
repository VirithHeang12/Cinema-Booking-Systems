<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Classification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassificationPolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_CLASSIFICATIONS) ?
            Response::allow() :
            Response::deny('You do not have permission to view classifications.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Classification $classification): Response
    {
        return $user->can(PermissionEnum::VIEW_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to view this classification.');
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
        return $user->can(PermissionEnum::CREATE_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to create classifications.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Classification  $classification
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Classification $classification): Response
    {
        return $user->can(PermissionEnum::UPDATE_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to update this classification.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Classification  $classification
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Classification $classification): Response
    {
        return $user->can(PermissionEnum::DELETE_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this classification.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Classification  $classification
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Classification $classification): Response
    {
        return $user->can(PermissionEnum::RESTORE_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this classification.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Classification  $classification
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Classification $classification): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this classification.');
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
        return $user->can(PermissionEnum::IMPORT_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to import classifications.');
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
        return $user->can(PermissionEnum::EXPORT_CLASSIFICATION) ?
            Response::allow() :
            Response::deny('You do not have permission to export classifications.');
    }
}
