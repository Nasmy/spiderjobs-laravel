<?php

namespace App;

class WorkPlace
{
    const ON_SITE = 'On-site';
    const HYBRID = 'Hybrid';
    const REMOTE = 'Remote';

    public static function toArray()
    {
        return [
            self::ON_SITE => self::ON_SITE,
            self::HYBRID => self::HYBRID,
            self::REMOTE => self::REMOTE,
        ];
    }

    public static function toString()
    {
        return implode(',', self::toArray());
    }
}