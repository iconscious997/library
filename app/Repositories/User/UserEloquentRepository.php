<?php

namespace App\Repositories\User;

use App\User;

class UserEloquentRepository
{
    /**
     * Update data at currently authenticated user.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        $user = $this->find($id);

        return $user->update($data);
    }

    /**
     * Find user in DB.
     *
     * @param int $id
     * @return User
     */
    public function find(int $id)
    {
        return User::find($id);
    }

    /**
     * Update count of owned books on user.
     *
     * @param User $user
     * @return mixed
     */
    public function updateOwnedBooks(User $user)
    {
        $data['owned_books'] = $user->owned_books + 1;
        $data['verified'] = $user->isVerified();

        return $data;
    }
}