<?php

namespace App\Repositories\User;

use App\User;

class UserEloquentRepository
{
    /**
     * Minimum of owned books for user, to be trustworthy.
     *
     * @var int
     */
    protected $minimumOwnedBooks = 5;

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
        $data['verified'] = $this->isVerified($user);

        return $data;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isVerified(User $user)
    {
        if ($user->owned_books >= $this->minimumOwnedBooks) {
            return true;
        }

        return false;
    }
}