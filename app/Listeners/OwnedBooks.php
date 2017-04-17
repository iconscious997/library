<?php

namespace App\Listeners;

use App\Events\BookStored;

class OwnedBooks
{
    /**
     * Handle the event.
     *
     * @param  BookStored  $event
     * @return void
     */
    public function handle(BookStored $event)
    {
        $user = resolve('App\Repositories\User\UserInterface');

        $userData = $user->updateOwnedBooks($event->user);

        if (isset($userData)) {
            $user->update($event->user->id, $userData);
        }
    }
}
