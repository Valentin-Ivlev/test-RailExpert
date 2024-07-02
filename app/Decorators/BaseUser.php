<?php

namespace App\Decorators;

use App\Models\User;

class BaseUser implements UserSkillInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getDescription(): string
    {
        return '';
    }
}
