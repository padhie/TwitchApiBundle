<?php

namespace Padhie\TwitchApiBundle\Model;

interface TwitchModelInterface extends \JsonSerializable
{
    public const DATETIME_FORMAT = 'Y-m-d\TH:i:s\Z';
    public const DATETIME_FORMAT_DETAILED = 'Y-m-d\TH:i:s.u\Z';

    /**
     * @param array<string, mixed> $json
     * @return TwitchModelInterface
     */
    public static function createFromJson(array $json);

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array;
}