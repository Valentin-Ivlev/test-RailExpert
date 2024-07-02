<?php

namespace App\Decorators;

class PhpSkillDecorator extends SkillDecorator
{
    public function getDescription(): string
    {
        return trim($this->user->getDescription() . ' PHP');
    }
}
