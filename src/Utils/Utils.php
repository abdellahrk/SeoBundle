<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the SEO Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

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