<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function view(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id;
    }

    /**
     * Determine whether the user can create collections.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function update(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id;
    }

    /**
     * Determine whether the user can delete the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function delete(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id;
    }

    /**
     * Determine whether the user can restore the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function restore(User $user, Collection $collection)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function forceDelete(User $user, Collection $collection)
    {
        //
    }
}
