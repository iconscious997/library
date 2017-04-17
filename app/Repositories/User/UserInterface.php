<?php

namespace App\Repositories\User;

use App\User;

interface UserInterface
{
    /**
     * Update data at currently authenticated user.
     *
     * @param array $data
     * @return bool
     */
    public function updateAuthenticated(array $data);

    /**
     * Find user in DB.
     *
     * @param int $id
     * @return \App\User
     */
    public function find(int $id);

    /**
     * Update count of owned books on user.
     *
     * @param \App\User $user
     * @return mixed
     */
    public function updateOwnedBooks(User $user);
}