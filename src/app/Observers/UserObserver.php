<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Appraiser;
use App\Enums\UserType;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saving(User $user)
    {
        if($user->level == UserType::APPRAISER) {
            $user->role = "APPRAISER";
        }
        else if( $user->level == UserType::ADMINISTRATOR ) {
            $user->role = "ADMINISTRATOR";
        }
        else if( $user->level == UserType::ROOT ) {
            $user->role = "ROOT";
        } 
        else {
            $user->role = "STUDENT";
        }
    }

    /**
     * Handle the user "saved" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        //
        if($user->level == UserType::APPRAISER) {

            $appraiser = Appraiser::updateOrCreate(
                ['user_id' => $user->id],
                ['name' => $user->name]
            );
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
