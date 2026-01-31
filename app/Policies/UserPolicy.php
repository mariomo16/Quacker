<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Permite que el usuario solo gestione su propio perfil.
     */
    public function manageProfile(User $user)
    {
        return $user->id === auth()->id();
    }
}
