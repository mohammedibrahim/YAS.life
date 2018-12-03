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

    protected $responseDate = [
        'response Data'
    ];

    /**
     * setUp.
     */
    public function setUp()
    {
        $this->response = new CountryResponse($this->responseDate);
    }

    /**
     * testCreate.
     */
    public function testGet()
    {
        $result = $this->response->get();

        $this->assertEquals(implode("\n", $this->responseDate) . "\n", $result);
    }
}