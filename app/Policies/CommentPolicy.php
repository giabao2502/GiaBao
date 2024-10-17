<?php

namespace App\Policies;

use App\Models\User;

use App\Models\Customer;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;


class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function changeComment(Customer $customer, Comment $comment)
    {
        return $customer->id === $comment->customer_id;
    }
}
