<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Tests\Request;

use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Request\RequestGenerator;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

final class RequestGeneratorTest extends TestCase
{
    private const CLIENT_ID = 'any-client-id';
    private const AUTHORIZATION = 'any-authorization';

    private RequestGenerator $requestGenerator;

    protected function setUp(): void
    {
        $this->requestGenerator = new RequestGenerator(self::CLIENT_ID, self::AUTHORIZATION);
    }

    public function dataProviderGenerateWithInvalidRequest(): \Generator
    {
        $requestWitInvalidMethod = $this->createMock(RequestInterface::class);
        $requestWitInvalidMethod->method('getMethod')->willReturn('any-method');
        yield 'invalid-method' => [
            'request' => $requestWitInvalidMethod,
            'expectedExceptionMessage' => 'Method is not allowed',
        ];

        $requestWithInvalidUri = $this->createMock(RequestInterface::class);
        $requestWithInvalidUri->method('getMethod')->willReturn(RequestInterface::METHOD_GET);
        $requestWithInvalidUri->method('getUrl')->willReturn('');
        yield 'invalid-url' => [
            'request' => $requestWithInvalidUri,
            'expectedExceptionMessage' => 'URL is empty',
        ];

        $requestWithInvalidResponseClass = $this->createMock(RequestInterface::class);
        $requestWithInvalidResponseClass->method('getMethod')->willReturn(RequestInterface::METHOD_GET);
        $requestWithInvalidResponseClass->method('getUrl')->willReturn('any-url');
        $requestWithInvalidResponseClass->method('getResponseClass')->willReturn(stdClass::class);
        yield 'invalid-response-class' => [
            'request' => $requestWithInvalidResponseClass,
            'expectedExceptionMessage' => 'Response need implement ResponseInterface',
        ];
    }

    /**
     * @dataProvider dataProviderGenerateWithInvalidRequest
     */
    public function testGenerateWithInvalidRequest(RequestInterface $request, string $expectedExceptionMessage): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->requestGenerator->generate($request);
    }

    public function testGenerate(): void
    {
        $prsRequest = $this->requestGenerator->generate(new TestRequest());

        self::assertSame('GET', $prsRequest->getMethod());
        self::assertSame('google.de', $prsRequest->getUri()->getHost());
        self::assertSame('{"field":"f-value"}', $prsRequest->getBody()->getContents());
        self::assertSame('query=q-value', $prsRequest->getUri()->getQuery());
        self::assertSame(
            [
                'Host' => ['google.de'],
                'Client-ID' => [self::CLIENT_ID],
                'Authorization' => ['Bearer ' . self::AUTHORIZATION],
                'Content-Type' => ['application/json'],
                'x-custom-header' => ['foobar'],
            ],
            $prsRequest->getHeaders()
        );
    }
}