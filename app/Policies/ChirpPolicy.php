<?php

namespace App\Policies;


class ChirpPolicy extends Policies
{
/**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        // le user associé au chirp peut le modifier s'il est identique au user en paramètre
        return $chirp->user()->is($user);
    }

    public function delete(User $user, Chirp $chirp): bool
    {
        // le user associé au chirp peut le supprimer s'il est identique au user en paramètre
        return $this->update($user, $chirp);
    }
}
