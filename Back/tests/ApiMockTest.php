
<?php

use App\Service\RickAndMortyGestion;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class ApiMockTest extends WebTestCase {

    
    public function testProducts() : void {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/products');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertNotEmpty($responseData);
    }

    /** @test */
    public function products(): void {

        $expectedResponseData = [[
            'id' => 1,
            'name' => 'Test product',
            'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
            'price' => '20',
            'quantity' =>  6,
            ],
            [
                'id' => 2,
                'name' => 'Test product 2',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '15',
                'quantity' =>  10,
            ],
            [
                'id' => 3,
                'name' => 'Test product 3',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '25',
                'quantity' =>  16,
            ],
            [
                'id' => 4,
                'name' => 'Test product 4',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '15',
                'quantity' =>  5,
            ]
        ];

        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $response = $httpClient->request('GET', 'api/products', [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ]
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }
        
        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('GET', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/products', $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertNotEmpty($responseData);
    }

    /** @test */
    public function addProduct(): void {
        $requestData = [
            'name' => 'Test product',
            'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
            'price' => '15',
            'quantity' =>  6,
        ];
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = [
            'id' => 21,
            'name' => 'Test product',
            'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
            'price' => '15',
            'quantity' =>  6,
        ];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $requestJson = json_encode($requestData, JSON_THROW_ON_ERROR);

        $response = $httpClient->request('POST', 'api/products', [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'body' => $requestJson,
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/products', $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($expectedRequestData, $mockResponse->getRequestOptions()['body']);
        $this->assertSame($responseData, $expectedResponseData);
    }

    /** @test */
    public function product(): void {
        $requestData = 21;
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = [
            'id' => 21,
            'name' => 'Test product',
            'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
            'price' => '15',
            'quantity' =>  6,
        ];

        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $response = $httpClient->request('GET', 'api/products/'.$requestData, [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('GET', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/products/'.$requestData, $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($responseData, $expectedResponseData);
    }

    /** @test */
    public function addProductCart(): void {
        $requestData = [
            'quantity' =>  2,
        ];
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = [
            'id' => 1,
            'products' => [
                'id' => 21,
                'name' => 'Test product',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '15',
                'quantity' =>  6,
            ]
        ];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $requestJson = json_encode($requestData, JSON_THROW_ON_ERROR);

        $response = $httpClient->request('POST', 'api/cart/21', [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'body' => $requestJson,
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/cart/21', $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($expectedRequestData, $mockResponse->getRequestOptions()['body']);
        $this->assertSame($responseData, $expectedResponseData);
    }
    
    /** @test */
    public function addProductCartMany(): void {
        $requestData = [
            'quantity' => 100,
        ];
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = ["error" => "too many"];
        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $requestJson = json_encode($requestData, JSON_THROW_ON_ERROR);

        $response = $httpClient->request('POST', 'api/cart/1', [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
            'body' => $requestJson,
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('POST', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/cart/1', $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($expectedRequestData, $mockResponse->getRequestOptions()['body']);
        $this->assertSame($responseData, $expectedResponseData);
    }

    /** @test */
    public function cart(): void {

        $expectedResponseData = [
            'id' => 1,
            'products' => [[
            'id' => 1,
            'name' => 'Test product',
            'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
            'price' => '20',
            'quantity' =>  6,
            ],
            [
                'id' => 2,
                'name' => 'Test product 2',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '15',
                'quantity' =>  10,
            ],
            [
                'id' => 3,
                'name' => 'Test product 3',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '25',
                'quantity' =>  16,
            ],
            [
                'id' => 4,
                'name' => 'Test product 4',
                'image' => 'https://rickandmortyapi.com/api/character/avatar/2.jpeg',
                'price' => '15',
                'quantity' =>  5,
            ]
        ]];

        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $response = $httpClient->request('GET', 'api/cart', [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ]
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }
        
        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('GET', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/cart', $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertNotEmpty($responseData);
    }
    
    /** @test */
    public function deleteCart(): void {
        $requestData = 1;
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = ['delete' => 'ok'];

        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $response = $httpClient->request('DELETE', 'api/cart/'.$requestData, [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('DELETE', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/cart/'.$requestData, $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($responseData, $expectedResponseData);
    }

    /** @test */
    public function deleteProduct(): void {
        $requestData = 21;
        $expectedRequestData = json_encode($requestData, JSON_THROW_ON_ERROR);

        $expectedResponseData = ['delete' => 'ok'];

        $mockResponseJson = json_encode($expectedResponseData, JSON_THROW_ON_ERROR);
        $mockResponse = new MockResponse($mockResponseJson, [
            'http_code' => 201,
            'response_headers' => ['Content-Type: application/json'],
        ]);
        
        $httpClient = new MockHttpClient($mockResponse, 'http://localhost:8000');

        $response = $httpClient->request('DELETE', 'api/products/'.$requestData, [
            'headers' => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new Exception('Response status code is different than expected.');
        }

        $responseJson = $response->getContent();
        $responseData = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $this->assertEquals('DELETE', $mockResponse->getRequestMethod());
        $this->assertSame('http://localhost:8000/api/products/'.$requestData, $mockResponse->getRequestUrl());
        $this->assertContains('Content-Type: application/json', $mockResponse->getRequestOptions()['headers']);
        $this->assertSame($responseData, $expectedResponseData);
    }

}

?>