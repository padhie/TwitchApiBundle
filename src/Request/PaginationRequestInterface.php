<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request;

interface PaginationRequestInterface extends RequestInterface
{
    public function withAfter(string $after): PaginationRequestInterface;
}