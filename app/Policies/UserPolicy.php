<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    // Evita que se puedan hacer peticiones POST para actualizar usuarios distintos al usuario autenticado
    public function updateUser(User $user)
    {
        return $user->id === auth()->id();
    }
}
