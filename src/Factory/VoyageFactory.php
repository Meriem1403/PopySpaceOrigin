<?php

namespace App\Factory;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use DateTimeImmutable;

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
 * @method static VoyageRepository|RepositoryProxy repository()
 * @method static Voyage[]|Proxy[]                 all()
 * @method static Voyage[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Voyage[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Voyage[]|Proxy[]                 findBy(array $attributes)
 * @method static Voyage[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Voyage[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VoyageFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'depart' => DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('+1 day', '+1 year')),
            'planete' => PlaneteFactory::new(),
            'objectif' => self::faker()->sentence(),
            'upgradeTrouDeVer' => self::faker()->boolean(25), // 25 % de chance qu'il soit activé
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
