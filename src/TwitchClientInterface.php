<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle;

use Padhie\TwitchApiBundle\Request\PaginationRequestInterface;
use Padhie\TwitchApiBundle\Request\RequestInterface;
use Padhie\TwitchApiBundle\Response\ResponseInterface;

interface TwitchClientInterface
{
    public function send(RequestInterface $request): ResponseInterface;

    public function sendWithPagination(PaginationRequestInterface $request): ResponseInterface;

    /**
     * @param array<int|string, RequestInterface> $requests
     * @return array<int|string, ResponseInterface|null> key is related to request
     */
    public function sendAsync(array $requests): array;
}