<?php

namespace Padhie\Tests;

class FixtureHelper
{
    public static function loadJsonFixture(String $filename): array
    {
        $raw = file_get_contents(__DIR__ . '/Fixtures/' . $filename . '.json');
        return json_decode($raw, true);
    }
}