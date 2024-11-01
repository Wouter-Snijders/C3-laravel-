<?php

namespace App\Policies;

use App\Models\Advertentie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdvertentiePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Laat alle ingelogde gebruikers advertenties zien
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Advertentie $advertentie): bool
    {
        return true; // Laat alle ingelogde gebruikers een specifieke advertentie zien
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Laat alle ingelogde gebruikers advertenties aanmaken
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Advertentie $advertentie): bool
    {
        return $user->id === $advertentie->user_id; // Alleen de eigenaar van de advertentie kan deze bijwerken
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Advertentie $advertentie): bool
    {
        return $user->id === $advertentie->user_id; // Alleen de eigenaar van de advertentie kan deze verwijderen
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Advertentie $advertentie): bool
    {
        return $user->id === $advertentie->user_id; // Alleen de eigenaar van de advertentie kan deze herstellen
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Advertentie $advertentie): bool
    {
        return $user->id === $advertentie->user_id; // Alleen de eigenaar van de advertentie kan deze permanent verwijderen
    }
}
