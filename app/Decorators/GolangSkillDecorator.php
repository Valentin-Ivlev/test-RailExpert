<?php

namespace App\Decorators;

class GolangSkillDecorator extends SkillDecorator
{
    public function getDescription(): string
    {
        return trim($this->user->getDescription() . ' Golang');
    }
}
