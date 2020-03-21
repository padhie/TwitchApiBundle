<?php

namespace Padhie\TwitchApiBundle\Model;

interface TwitchModelInterface
{
    public const DATETIME_FORMAT = 'Y-m-d\TH:i:s\Z';
    public const DATETIME_FORMAT_DETAILED = 'Y-m-d\TH:i:s.u\Z';
    public static function createFromJson(array $json);
}