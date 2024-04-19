<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Comment;


class CommentService
{

    public function store(User $user, string $comment)
    {

        // according to the models a user can have many
        // comments but we've not implemented it that way
        // for now. So, for now, first delete, then recreate
        // a user's comments.

        $comments = $user->comments;
        foreach ($comments as $userComment) {
            $userComment->delete();
        }
        
        $commentObject = new Comment();
        $commentObject->comment = $comment;
        $commentObject->user_id = $user->id;
        $commentObject->save();

        return $commentObject->id;
    }
}
