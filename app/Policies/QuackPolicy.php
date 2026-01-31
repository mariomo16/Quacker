<?php

namespace App\Policies;

use App\Models\Quack;
use App\Models\User;

class QuackPolicy
{
    // Método para comprobar si el quack pertenece al usuario
    public function manage(User $user, Quack $quack)
    {
        return $user->id === $quack->user_id;
    }
}
