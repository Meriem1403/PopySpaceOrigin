<?php

namespace App\Factory;

use App\Entity\Planete;
use App\Repository\PlaneteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

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
    public const NOM_PLANETES = [
        'Mercure',
        'Vénus',
        'Terre',
        'Mars',
        'Jupiter',
        'Saturne',
        'Uranus',
        'Neptune',
    ];

    public const AUTRES_NOMS = [
        'Proxima Centauri b',
        'Kepler-186f',
        'Kepler-62e',
        'Kepler-62f',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'nom' => self::faker()->randomElement(self::NOM_PLANETES),
            'description' => self::faker()->paragraph(),
            'distanceLumiereTerre' => self::faker()->randomFloat(2, 1, 1000),
            'image' => 'planete-' . self::faker()->numberBetween(1, 4) . '.png',
            'dansVoieLactee' => true,
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
