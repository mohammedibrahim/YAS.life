<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations;

use YASLife\Contracts\CountryAPIsContract;
use YASLife\Implementations\CountryRepository;
use YASLifeTest\UnitTest;

/**
 * Country Repository Test
 *
 * Class Repository
 * @package YASLife\Implementations
 */
class CountryRepositoryTest extends UnitTest
{
    /**
     * repository.
     *
     * @var CountryRepository
     */
    protected $repository;

    public function setUp()
    {
        $this->repository = $this->createClassWithAbstractParams(CountryRepository::class, [CountryAPIsContract::class], [
            CountryAPIsContract::class => [
                'getCountry' => [['languages' => [['iso639_1' => 'ar']]]],
                'countriesSpeakLanguage' => [
                    ['name' => 'Egypt'],
                    ['name' => 'Algeria'],
                    ['name' => 'Saudi Arabia'],
                    ['name' => 'Libya'],
                    ['name' => 'Syria'],
                ],
            ]
        ]);
    }

    /**
     * testGetByName.
     */
    public function testGetByName()
    {
        $result = $this->repository->getByName('Egypt');

        $this->assertArrayHasKey('country', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('countries', $result);

        $this->assertEquals($result['country'], 'Egypt');
        $this->assertEquals($result['code'], 'ar');
        $this->assertEquals(json_encode($result['countries']), json_encode(['Algeria', 'Saudi Arabia', 'Libya', 'Syria']));
    }
}