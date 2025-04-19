<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\HallSeatType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HallSeatTypePolicy
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
        return $user->can(PermissionEnum::VIEW_ANY_HALL_SEAT_TYPES)
            ? Response::allow()
            : Response::deny('You do not have permission to view hall seat types.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function view(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::VIEW_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to view this hall seat type.');
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
        return $user->can(PermissionEnum::CREATE_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to create hall seat types.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::UPDATE_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to update this hall seat type.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::DELETE_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this hall seat type.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function restore(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::RESTORE_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this hall seat type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function forceDelete(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::FORCE_DELETE_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this hall seat type.');
    }

    /**
     * Determine whether the user can import the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function import(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::IMPORT_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to import hall seat types.');
    }

    /**
     * Determine whether the user can export the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HallSeatType  $hallSeatType
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function export(User $user, HallSeatType $hallSeatType): Response
    {
        return $user->can(PermissionEnum::EXPORT_HALL_SEAT_TYPE)
            ? Response::allow()
            : Response::deny('You do not have permission to export hall seat types.');
    }
}
