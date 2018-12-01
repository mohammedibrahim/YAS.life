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

use YASLife\Implementations\CountryRequest;
use YASLifeTest\UnitTest;

/**
 * Country Request Test
 *
 * Class Request
 * @package YASLife\Implementations
 */
class CountryRequestTest extends UnitTest
{
    /**
     * Request.
     *
     * @var CountryRequest
     */
    protected $request;


    /**
     * Setup method.
     */
    public function setUp()
    {
        $this->request = new CountryRequest([1 => 'Egypt']);
    }

    /**
     * Test Get method.
     */
    public function testGet()
    {
        $result = $this->request->get();
        $this->assertEquals($result[1], 'Egypt');
    }

}