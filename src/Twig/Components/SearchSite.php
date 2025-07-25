<?php
// src/Twig/Components/RechercheSite.php

namespace App\Twig\Components;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('recherche_site')]
class SearchSite
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $requete = '';

    public function __construct(private readonly VoyageRepository $voyageRepository)
    {
    }

    /**
     * @return Voyage[]
     */
    public function voyages(): array
    {
        if ('' === $this->requete) {
            return [];
        }

        return $this->voyageRepository->findBySearch($this->requete, [], 10);
    }
}
