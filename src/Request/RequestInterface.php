<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request;

interface RequestInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';
    public const METHOD_PATCH = 'PATCH';

    /**
     * @see RequestInterface::METHOD_GET
     * @see RequestInterface::METHOD_POST
     * @see RequestInterface::METHOD_PUT
     * @see RequestInterface::METHOD_DELETE
     * @see RequestInterface::METHOD_PATCH
     */
    public function getMethod(): string;

    public function getUrl(): string;

    /**
     * @return array<mixed>
     */
    public function getHeader(): array;

    /**
     * @return array<mixed>
     */
    public function getParameter(): array;

    /**
     * @return array<mixed>
     */
    public function getBody(): array;

    /**
     * Class must be implement ResponseInterface
     */
    public function getResponseClass(): string;
}