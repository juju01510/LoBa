<?php

namespace App\Factory;

use App\Entity\Partners;
use App\Repository\PartnersRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Partners>
 *
 * @method        Partners|Proxy create(array|callable $attributes = [])
 * @method static Partners|Proxy createOne(array $attributes = [])
 * @method static Partners|Proxy find(object|array|mixed $criteria)
 * @method static Partners|Proxy findOrCreate(array $attributes)
 * @method static Partners|Proxy first(string $sortedField = 'id')
 * @method static Partners|Proxy last(string $sortedField = 'id')
 * @method static Partners|Proxy random(array $attributes = [])
 * @method static Partners|Proxy randomOrCreate(array $attributes = [])
 * @method static PartnersRepository|RepositoryProxy repository()
 * @method static Partners[]|Proxy[] all()
 * @method static Partners[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Partners[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Partners[]|Proxy[] findBy(array $attributes)
 * @method static Partners[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Partners[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PartnersFactory extends ModelFactory
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
            'logo' => 'african-5035645_1920.jpg',
            'name' => self::faker()->text(255),
            'link' => 'https://partner.com'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Partners $partners): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Partners::class;
    }
}
