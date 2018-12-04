<?php
/**
 * YAS.life.
 *
 * @package     YAS.life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations\Factories;

use YASLife\Implementations\Factories\CountryResponseFactory;
use YASLifeTest\UnitTest;

/**
 * Country Response Test
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class CountryResponseFactoryTest extends UnitTest
{
    /**
     * test create method .
     */
    public function testCreate()
    {
        $data = ['custom data', 'custom data'];
        $this->assertEquals(sprintf('%s%s',implode(PHP_EOL, $data), PHP_EOL), CountryResponseFactory::create($data)->get());
    }
}