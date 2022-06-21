<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Document $document)
    {
        return $document->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param   array $ids
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, array $ids)
    {
        $documentsOwned = Document::whereIn('slug', $ids)
                            ->where('user_id', $user->id)->count();

        return $documentsOwned === count($ids);
    }
}
