<?php

namespace App\Factory;

use App\Entity\Voyage;
use App\Factory\PlaneteFactory;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Voyage>
 *
 * @method        Voyage|Proxy                     create(array|callable $attributes = [])
 * @method static Voyage|Proxy                     createOne(array $attributes = [])
 * @method static Voyage|Proxy                     find(object|array|mixed $criteria)
 * @method static Voyage|Proxy                     findOrCreate(array $attributes)
 * @method static Voyage|Proxy                     first(string $sortedField = 'id')
 * @method static Voyage|Proxy                     last(string $sortedField = 'id')
 * @method static Voyage|Proxy                     random(array $attributes = [])
 * @method static Voyage|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RepositoryProxy|VoyageRepository repository()
 * @method static Voyage[]|Proxy[]                 all()
 * @method static Voyage[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Voyage[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Voyage[]|Proxy[]                 findBy(array $attributes)
 * @method static Voyage[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Voyage[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VoyageFactory extends ModelFactory
{
    private const OBJECTIFS_SPATIAUX = [
        'Installer une base de recherche sur la surface.',
        'Explorer les gisements de minerais rares.',
        'Établir un avant-poste de communication galactique.',
        'Analyser l’atmosphère pour une éventuelle colonisation.',
        'Cartographier les reliefs et les structures naturelles.',
        'Capturer des échantillons de sol extraterrestre.',
        'Créer un couloir commercial interstellaire.',
        'Évaluer les risques de radiation dans la zone orbitale.',
        'Effectuer des tests de terraformage automatisés.',
        'Scanner l’activité magnétique de la planète.',
        'Étudier la faune et flore potentiellement présentes.',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create('fr_FR');

        return [
            'depart'            => \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('+1 day', '+1 year')),
            'planete'           => PlaneteFactory::new(),
            'objectif'          => $faker->randomElement(self::OBJECTIFS_SPATIAUX),
            'upgradeTrouDeVer'  => $faker->boolean(30),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Voyage::class;
    }
}
