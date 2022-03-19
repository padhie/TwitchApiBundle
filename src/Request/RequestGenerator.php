<?php

declare(strict_types=1);

namespace Padhie\TwitchApiBundle\Request;

use GuzzleHttp\Psr7\Request;
use JsonException;
use Padhie\TwitchApiBundle\Exception\InvalidRequestException;
use Padhie\TwitchApiBundle\Response\ResponseInterface;
use Psr\Http\Message\RequestInterface as PsrRequestInterface;

use function array_key_exists;
use function array_merge;
use function count;
use function implode;
use function in_array;
use function sprintf;
use function trim;

final class RequestGenerator
{
    private const ALLOWED_METHODS = [
        RequestInterface::METHOD_GET,
        RequestInterface::METHOD_POST,
        RequestInterface::METHOD_PUT,
        RequestInterface::METHOD_DELETE,
        RequestInterface::METHOD_PATCH,
    ];

    private string $clientId;
    private string $authorization;

    public function __construct(string $clientId, string $authorization)
    {
        $this->clientId = $clientId;
        $this->authorization = $authorization;
    }

    /**
     * @throws InvalidRequestException
     * @throws JsonException
     */
    public function generate(RequestInterface $request): PsrRequestInterface
    {
        $this->validate($request);

        return new Request(
            $request->getMethod(),
            $this->generateUri($request),
            $this->generateHeader($request),
            $this->generateBody($request)
        );
    }

    /**
     * @throws InvalidRequestException
     */
    private function validate(RequestInterface $request): void
    {
        if (!in_array($request->getMethod(), self::ALLOWED_METHODS, true)) {
            throw new InvalidRequestException('Method is not allowed');
        }

        if (trim($request->getUrl()) === '') {
            throw new InvalidRequestException('URL is empty');
        }

        $responseClass = $request->getResponseClass();
        $responseClassImplements = class_implements($responseClass);
        if (!in_array(ResponseInterface::class, $responseClassImplements, true)) {
            throw new InvalidRequestException('Response need implement XYZInterface');
        }
    }

    private function generateUri(RequestInterface $request): string
    {
        return sprintf(
            '%s?%s',
            $request->getUrl(),
            http_build_query($request->getParameter())
        );
    }

    /**
     * @param array<mixed> $header
     * @return array<mixed>
     */
    private function generateHeader(RequestInterface $request): array
    {
        return array_merge(
            [
                'Client-ID' => $this->clientId,
                'Authorization' => 'Bearer ' . $this->authorization,
                'Content-Type' => 'application/json',
            ],
            $request->getHeader()
        );
    }

    /**
     * @throws JsonException
     */
    private function generateBody(RequestInterface $request): ?string
    {
        return count($request->getBody()) > 0
            ? json_encode($request->getBody(), JSON_THROW_ON_ERROR)
            : null;
    }
}