<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Minimum number of user books
    |--------------------------------------------------------------------------
    |
    | This value is the minimal number of books which should be owned by user
    | to be this user marked as trustworthy. Otherwise this user can't see
    | type of book and shelf in which is book stored.
    |
    */

    'books_owned_by_user' => env('BOOKS_OWNED_BY_USER', 5)

];