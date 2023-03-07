<?php

namespace App\Factory;

use App\Entity\Introduction;
use App\Repository\IntroductionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Introduction>
 *
 * @method        Introduction|Proxy create(array|callable $attributes = [])
 * @method static Introduction|Proxy createOne(array $attributes = [])
 * @method static Introduction|Proxy find(object|array|mixed $criteria)
 * @method static Introduction|Proxy findOrCreate(array $attributes)
 * @method static Introduction|Proxy first(string $sortedField = 'id')
 * @method static Introduction|Proxy last(string $sortedField = 'id')
 * @method static Introduction|Proxy random(array $attributes = [])
 * @method static Introduction|Proxy randomOrCreate(array $attributes = [])
 * @method static IntroductionRepository|RepositoryProxy repository()
 * @method static Introduction[]|Proxy[] all()
 * @method static Introduction[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Introduction[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Introduction[]|Proxy[] findBy(array $attributes)
 * @method static Introduction[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Introduction[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class IntroductionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'content' => self::faker()->text(),
            'user' => UserFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Introduction $introduction): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Introduction::class;
    }
}
