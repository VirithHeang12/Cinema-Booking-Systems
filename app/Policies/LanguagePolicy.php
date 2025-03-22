<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LanguagePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_LANGUAGES) ?
            Response::allow() :
            Response::deny('You do not have permission to view languages.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Language $language): Response
    {
        return $user->can(PermissionEnum::VIEW_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to view this language.');
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
        return $user->can(PermissionEnum::CREATE_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to create languages.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Language  $language
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Language $language): Response
    {
        return $user->can(PermissionEnum::UPDATE_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to update this language.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Language  $language
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Language $language): Response
    {
        return $user->can(PermissionEnum::DELETE_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this language.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Language  $language
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Language $language): Response
    {
        return $user->can(PermissionEnum::RESTORE_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this language.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Language  $language
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Language $language): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_LANGUAGE) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this language.');
    }
}
