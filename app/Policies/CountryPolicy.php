<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CountryPolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_COUNTRIES) ?
            Response::allow() :
            Response::deny('You do not have permission to view countries.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Country $country): Response
    {
        return $user->can(PermissionEnum::VIEW_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to view this country.');
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
        return $user->can(PermissionEnum::CREATE_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to create countries.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Country  $country
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Country $country): Response
    {
        return $user->can(PermissionEnum::UPDATE_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to update this country.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Country  $country
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Country $country): Response
    {
        return $user->can(PermissionEnum::DELETE_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this country.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Country  $country
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Country $country): Response
    {
        return $user->can(PermissionEnum::RESTORE_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this country.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Country  $country
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Country $country): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this country.');
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
        return $user->can(PermissionEnum::IMPORT_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to import countries.');
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
        return $user->can(PermissionEnum::EXPORT_COUNTRY) ?
            Response::allow() :
            Response::deny('You do not have permission to export countries.');
    }
}
