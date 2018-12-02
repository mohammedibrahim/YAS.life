<?php
/**
 * YAS.life
 *
 * @package     YAS.life Package
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (10/11/2018)
 * @copyright   Copyright (c) 2018
 */

namespace YASLifeTest;
/**
 * YAS.lif Package
 *
 * Abstract Class UnitTest
 * @package YASLifeTest
 */

use PHPUnit\Framework\MockObject\Stub\ReturnValueMap;
use PHPUnit\Framework\TestCase;

abstract class UnitTest extends TestCase
{
    /**
     * Create class with abstract params.
     *
     * @param $className
     * @param $params
     * @param array $mockMethods
     * @return mixed
     */
    public function createClassWithAbstractParams(string $className,array $params = [],array $mockMethods = []): object
    {
        $paramsMocks = [];

        foreach ($params as $param) {

            $mockClass = $this->getMockBuilder($param)
                ->disableOriginalConstructor()
                ->getMock();

            if (!empty($mockMethods[$param])) {

                foreach ($mockMethods[$param] as $method => $return) {

                    if ($return === $param) {
                        $return = $mockClass;
                    }

                    if (is_object($return) && get_class($return) === ReturnValueMap::class) {
                        $mockClass->method($method)->will($return);
                        continue;
                    }

                    $mockClass->method($method)->will($this->returnValue($return));
                }
            }

            $paramsMocks[] = $mockClass;
        }

        return new $className(...$paramsMocks);
    }
}