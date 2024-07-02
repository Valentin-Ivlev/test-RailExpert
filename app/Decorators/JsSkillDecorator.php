<?php

namespace App\Decorators;

class JsSkillDecorator extends SkillDecorator
{
    public function getDescription(): string
    {
        return trim($this->user->getDescription() . ' JS');
    }
}
