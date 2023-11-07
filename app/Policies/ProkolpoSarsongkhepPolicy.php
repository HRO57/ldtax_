<?php

namespace App\Policies;

use App\Models\User;
use App\Models\prokolpo_sarsongkhep;
use Illuminate\Auth\Access\Response;

class ProkolpoSarsongkhepPolicy
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
    public function view(User $user, prokolpo_sarsongkhep $prokolpoSarsongkhep): bool
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
    public function update(User $user, prokolpo_sarsongkhep $prokolpoSarsongkhep): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, prokolpo_sarsongkhep $prokolpoSarsongkhep): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, prokolpo_sarsongkhep $prokolpoSarsongkhep): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, prokolpo_sarsongkhep $prokolpoSarsongkhep): bool
    {
        //
    }
}
