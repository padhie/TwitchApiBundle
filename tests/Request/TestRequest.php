<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Tests\Request;

use Padhie\TwitchApiBundle\Tests\Response\TestResponse;
use Padhie\TwitchApiBundle\Request\RequestInterface;

final class TestRequest implements RequestInterface
{
    final public function getMethod(): string
    {
        return RequestInterface::METHOD_GET;
    }

    final public function getUrl(): string
    {
        return 'https://google.de';
    }

    final public function getHeader(): array
    {
        return [
            'x-custom-header' => 'foobar',
        ];
    }

    final public function getParameter(): array
    {
        return [
            'query' => 'q-value'
        ];
    }

    final public function getBody(): array
    {
        return [
            'field' => 'f-value',
        ];
    }

    final public function getResponseClass(): string
    {
        return TestResponse::class;
    }
}