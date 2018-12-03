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

use YASLife\Implementations\Factories\CountryRequestFactory;
use YASLifeTest\UnitTest;

/**
 * Country APIs Test
 *
 * Class CountryAPIs
 * @package YASLife\Implementations
 */
class CountryRequestFactoryTest extends UnitTest
{
    public function testCreate()
    {
        $data = ['custom data', 'custom data'];
        $this->assertEquals($data, CountryRequestFactory::create($data)->get());
    }
}