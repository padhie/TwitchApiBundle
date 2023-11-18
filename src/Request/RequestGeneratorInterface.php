<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request;

use Psr\Http\Message\RequestInterface as PsrRequestInterface;

interface RequestGeneratorInterface
{
    public function generate(RequestInterface $request): PsrRequestInterface;
}