<?php

namespace Rami\SeoBundle\Utils;



class Utils
{
    /**
     * @throws \DateMalformedStringException
     */
    public static function parseDateIsoToYear(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y'));
    }

    /**
     * @throws \DateMalformedStringException
     */
    public static function parseFullDateIso8601(\DateTime $date): \DateTime
    {
        return new \DateTime($date->format('Y-m-d'));
    }
}