<?php

namespace App\Factory;

use App\Entity\Planete;
use App\Repository\PlaneteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use Faker\Factory as FakerFactory;

/**
 * @extends ModelFactory<Planete>
 *
 * @method        Planete|Proxy                     create(array|callable $attributes = [])
 * @method static Planete|Proxy                     createOne(array $attributes = [])
 * @method static Planete|Proxy                     find(object|array|mixed $criteria)
 * @method static Planete|Proxy                     findOrCreate(array $attributes)
 * @method static Planete|Proxy                     first(string $sortedField = 'id')
 * @method static Planete|Proxy                     last(string $sortedField = 'id')
 * @method static Planete|Proxy                     random(array $attributes = [])
 * @method static Planete|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PlaneteRepository|RepositoryProxy repository()
 * @method static Planete[]|Proxy[]                 all()
 * @method static Planete[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Planete[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Planete[]|Proxy[]                 findBy(array $attributes)
 * @method static Planete[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Planete[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PlaneteFactory extends ModelFactory
{
    public const NOMS_GALACTIQUES = [
        'Mercure', 'Vénus', 'Terre', 'Mars', 'Jupiter', 'Saturne', 'Uranus', 'Neptune',
    ];

    public const NOMS_EXOPLANETES = [
        'Proxima Centauri b', 'Kepler-186f', 'Kepler-62e', 'Kepler-62f',
    ];

    public const AUTRES_NOMS = [
        'Pandora', 'LV-426', 'Hoth', 'Tatooine', 'Arrakis', 'Gallifrey', 'Namek', 'Cybertron',
    ];


    private const DESCRIPTIONS_FR = [
        'Une planète riche en ressources rares et en énergie solaire.',
        'Surface rocheuse instable mais atmosphère exploitable.',
        'Candidate idéale pour les colonies scientifiques avancées.',
        'Présence de formes de vie microbiennes détectée récemment.',
        'Activité volcanique intense, propice aux études thermiques.',
        'Magnétosphère puissante : bonne protection contre les radiations.',
        'Planète glacée mais stable, terrain favorable aux avant-postes.',
        'Géologie unique avec des matériaux inconnus sur Terre.',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        $faker = FakerFactory::create('fr_FR');

        return [
            'nom'                  => $faker->randomElement(array_merge(self::NOMS_GALACTIQUES, self::NOMS_EXOPLANETES)),
            'description'          => $faker->randomElement(self::DESCRIPTIONS_FR),
            'distanceLumiereTerre' => $faker->randomFloat(2, 0, 1000),
            'image'                => 'planete' . $faker->numberBetween(1, 4) . '.png',
            'dansVoieLactee'       => $faker->boolean(80),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Planete::class;
    }
}
