<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GenrePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_GENRES) ?
            Response::allow() :
            Response::deny('You do not have permission to view Genres.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Genre $Genre): Response
    {
        return $user->can(PermissionEnum::VIEW_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to view this genre.');
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
        return $user->can(PermissionEnum::CREATE_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to create genres.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Genre  $genre
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Genre $genre): Response
    {
        return $user->can(PermissionEnum::UPDATE_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to update this genre.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Genre  $genre
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Genre $genre): Response
    {
        return $user->can(PermissionEnum::DELETE_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to delete this genre.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Genre  $genre
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Genre $genre): Response
    {
        return $user->can(PermissionEnum::RESTORE_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to restore this genre.');
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param \App\Models\Genre  $genre
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Genre $genre): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to permanently delete this genre.');
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
        return $user->can(PermissionEnum::IMPORT_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to import genres.');
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
        return $user->can(PermissionEnum::EXPORT_GENRE) ?
            Response::allow() :
            Response::deny('You do not have permission to export genres.');
    }
}
