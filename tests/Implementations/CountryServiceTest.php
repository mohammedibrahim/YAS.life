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

use YASLife\Contracts\RequestContract;
use YASLife\Contracts\ResponseContract;
use YASLife\Implementations\CountryRepository;
use YASLife\Implementations\CountryService;
use YASLifeTest\UnitTest;

/**
 * Country Service
 *
 * Class CountryService
 * @package YASLife\Implementations
 */
class CountryServiceTest extends UnitTest
{
    /**
     * Data Request.
     *
     * @var
     */
    protected $requestData;

    /**
     * Api Response Data.
     *
     * @var
     */
    protected $apiResponseData;

    /**
     * response data of get method.
     *
     * @var
     */
    protected $responseGet;

    /**
     * service class.
     *
     * @var
     */
    protected $service;

    /**
     * Test Get Country Name.
     */
    public function testGetCountryName()
    {
        $this->requestData = [
            1 => 'Egypt'
        ];

        $this->apiResponseData = [
            [
                'Egypt',
                [
                    'country' => 'Egypt',
                    'code' => 'ar',
                    'countries' => ['algeria', 'Saudi Arabia', 'Libya', 'Syria']
                ]
            ]
        ];

        $this->responseGet =
            implode("\n", [
                'country_code' => 'Country language code: ' . $this->apiResponseData[0][1]['code'],
                'countries' => $this->apiResponseData[0][1]['country'] . ' speaks same language with these countries: ' . implode(', ', $this->apiResponseData[0][1]['countries'])
            ]) . "\n";

        $this->createRequestMock();

        $result = $this->service->getCountryName();

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals("Country language code: ar\nEgypt speaks same language with these countries: algeria, Saudi Arabia, Libya, Syria\n", $result->get());
    }

    /**
     * create Request Mock.
     */
    public function createRequestMock()
    {
        $this->service = $this->createClassWithAbstractParams(CountryService::class, [
            RequestContract::class,
            CountryRepository::class,
            ResponseContract::class
        ], [
            RequestContract::class => [
                'get' => $this->requestData,
            ],
            CountryRepository::class => [
                'getByName' => $this->returnValueMap($this->apiResponseData)
            ],
            ResponseContract::class => [
                'create' => null,
                'get' => $this->responseGet
            ]
        ]);
    }

    /**
     * Test Check Taking Language Not Match.
     */
    public function testCheckTakingLanguageNotMatch()
    {
        $this->requestData = [
            1 => 'Egypt',
            2 => 'Germany'
        ];

        $this->apiResponseData = [
            [
                'Egypt',
                [
                    'country' => 'Egypt',
                    'code' => 'ar',
                    'countries' => ['Algeria', 'Saudi Arabia', 'Libya', 'Syria']
                ],
            ],
            [
                'Germany',
                [
                    'country' => 'Germany',
                    'code' => 'de',
                    'countries' => ['Belgium,', 'Belgium', 'Liechtenstein,', 'Luxembourg']
                ],
            ]
        ];

        $this->responseGet = sprintf('%s and %s %s the same language.', $this->apiResponseData[0][1]['country'], $this->apiResponseData[1][1]['country'], $this->apiResponseData[0][1]['code'] !== $this->apiResponseData[1][1]['code'] ? 'do not speak' : 'speak');

        $this->createRequestMock();

        $result = $this->service->checkTakingLanguage();

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals("Egypt and Germany do not speak the same language.", $result->get());

    }

    /**
     * Test Check Taking Language Match.
     */
    public function testCheckTakingLanguageMatch()
    {
        $this->requestData = [
            1 => 'Egypt',
            2 => 'Saudi Arabia'
        ];

        $this->apiResponseData = [
            [
                'Egypt',
                [
                    'country' => 'Egypt',
                    'code' => 'ar',
                    'countries' => ['algeria', 'Saudi Arabia', 'Libya', 'Syria']
                ],
            ],
            [
                'Saudi Arabia',
                [
                    'country' => 'Saudi Arabia',
                    'code' => 'ar',
                    'countries' => ['algeria', 'Egypt', 'Libya', 'Syria']
                ],
            ]
        ];

        $this->responseGet = sprintf('%s and %s %s the same language.', $this->apiResponseData[0][1]['country'], $this->apiResponseData[1][1]['country'], $this->apiResponseData[0][1]['code'] !== $this->apiResponseData[1][1]['code'] ? 'do not speak' : 'speak');

        $this->createRequestMock();

        $result = $this->service->checkTakingLanguage();

        $this->assertInstanceOf(ResponseContract::class, $result);

        $this->assertEquals("Egypt and Saudi Arabia speak the same language.", $result->get());

    }
}