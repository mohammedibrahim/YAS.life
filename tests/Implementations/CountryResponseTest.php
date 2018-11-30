<?php
/**
 * YAS.Life.
 *
 * @package     YAS.Life.
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (30/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest\Implementations;

use YASLife\Implementations\CountryResponse;
use YASLifeTest\UnitTest;

/**
 * Country Test Response
 *
 * Class CountryResponse
 * @package YASLife\Implementations
 */
class CountryResponseTest extends UnitTest
{
    /**
     * Response.
     *
     * @var
     */
    protected $response;

    /**
     * setUp.
     */
    public function setUp()
    {
        $this->response = new CountryResponse();
    }

    /**
     * testCreate.
     */
    public function testCreate()
    {
        $data = ['test response'];

        $this->response->create($data);

        $result = $this->response->get();

        $this->assertEquals($result, implode("\n", $data) . "\n");
    }
}