<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use LogicException;

#[AsTwigComponent]
class Button
{
    public string $variant = 'default';
    public string $tag = 'button';

    #[ExposeInTemplate]
    public function getVariantClasses(): string
    {
        return match ($this->variant) {
            'default' => 'text-white bg-blue-500 hover:bg-blue-700',
            'success' => 'text-white bg-green-600 hover:bg-green-700',
            'danger'  => 'text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none',
            'link'    => 'text-white hover:underline',
            default   => throw new LogicException(sprintf('Type de bouton inconnu : "%s"', $this->variant)),
        };
    }
}
