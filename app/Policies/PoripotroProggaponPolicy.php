<?php

namespace App\Policies;

use App\Models\User;
use App\Models\poripotro_proggapon;
use Illuminate\Auth\Access\Response;

class PoripotroProggaponPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, poripotro_proggapon $poripotroProggapon): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, poripotro_proggapon $poripotroProggapon): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, poripotro_proggapon $poripotroProggapon): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, poripotro_proggapon $poripotroProggapon): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, poripotro_proggapon $poripotroProggapon): bool
    {
        //
    }
}
