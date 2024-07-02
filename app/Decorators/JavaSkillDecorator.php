<?php

namespace App\Decorators;

class JavaSkillDecorator extends SkillDecorator
{
    public function getDescription(): string
    {
        return trim($this->user->getDescription() . ' Java');
    }
}
