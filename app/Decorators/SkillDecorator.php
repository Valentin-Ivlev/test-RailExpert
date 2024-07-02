<?php

namespace App\Decorators;

abstract class SkillDecorator implements UserSkillInterface
{
    protected $user;

    public function __construct(UserSkillInterface $user)
    {
        $this->user = $user;
    }

    public function getDescription(): string
    {
        return $this->user->getDescription();
    }
}
