<?php

namespace App\Policies;

use App\Models\Quack;
use App\Models\User;

class QuackPolicy
{
    /**
     * Permite que un usuario gestione un quack solo si es el autor.
     */
    public function manage(User $user, Quack $quack)
    {
        return $user->id === $quack->user_id;
    }
}
