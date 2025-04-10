<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\SeatType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SeatTypePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_SEAT_TYPES)
            ? Response::allow()
            : Response::deny('You do not have permission to view seat types.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, SeatType $seatType): Response
    {
        return $user->can(PermissionEnum::VIEW_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to view this seat type.');
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
        return $user->can(PermissionEnum::CREATE_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to create seat types.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, SeatType $seatType): Response
    {
        return $user->can(PermissionEnum::UPDATE_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to update this seat type.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, SeatType $seatType): Response
    {
        return $user->can(PermissionEnum::DELETE_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this seat type.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, SeatType $seatType): Response
    {
        return $user->can(PermissionEnum::RESTORE_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this seat type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatType  $seatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, SeatType $seatType): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this seat type.');
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
        return $user->can(PermissionEnum::IMPORT_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to import seat types.');
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
        return $user->can(PermissionEnum::EXPORT_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to export seat types.');
    }
}
