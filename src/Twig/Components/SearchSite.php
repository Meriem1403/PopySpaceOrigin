<?php

namespace App\Twig\Components;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class SearchSite
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        readonly private VoyageRepository $voyageRepository
    ) {}

    /**
     * @return Voyage[]
     */
    public function voyages(): array
    {
        $trimmed = trim($this->query);

        if ($trimmed === '') {
            return [];
        }

        return $this->voyageRepository->findBySearch($trimmed, [], 10);
    }
}
