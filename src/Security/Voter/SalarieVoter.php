<?php

namespace App\Security\Voter;

use App\Entity\medecin;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class SalarieVoter extends Voter
{
    const EDIT = 'edit';
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        if (!in_array($attribute, [ self::EDIT])) {
            return false;
        }

        // only vote on `Post` objects
        if (!$subject instanceof Salarie) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        /** @var Salarie $salarie */
        $salarie = $subject;
        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {

            case self::EDIT:
                return $this->canEdit($salarie, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Salarie $salarie, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($salarie, $user)) {
            return true;
        }

        // the Post object could have, for example, a method `isPrivate()`
        return !$salarie->isPrivate();
    }

    private function canEdit(Salarie $salarie, User $user)
    {
        // this assumes that the Post object has a `getOwner()` method
        return $user === $salarie->getOwner();
    }
}

