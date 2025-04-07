<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoviePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_MOVIES)
            ? Response::allow()
            : Response::deny('You do not have permission to view any movies.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, Movie $movie): Response
    {
        return $user->can(PermissionEnum::VIEW_MOVIE)
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
        return $user->can(PermissionEnum::CREATE_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to create movies.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Movie $movie): Response
    {
        return $user->can(PermissionEnum::UPDATE_MOVIE)
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
    public function delete(User $user, Movie $movie): Response
    {
        return $user->can(PermissionEnum::DELETE_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this movie.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, Movie $movie): Response
    {
        return $user->can(PermissionEnum::RESTORE_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this movie.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, Movie $movie): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this movie.');
    }

    /**
     * Determine whether the user can import movies.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user): Response
    {
        return $user->can(PermissionEnum::IMPORT_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to import movies.');
    }

    /**
     * Determine whether the user can export movies.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user): Response
    {
        return $user->can(PermissionEnum::EXPORT_MOVIE)
            ? Response::allow()
            : Response::deny('You do not have permission to export movies.');
    }
}
