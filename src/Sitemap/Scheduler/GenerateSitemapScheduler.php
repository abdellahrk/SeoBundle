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

namespace Rami\SeoBundle\Sitemap\Scheduler;

use Rami\SeoBundle\Sitemap\Message\GenerateSitemapMessage;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Component\Scheduler\Trigger\TriggerInterface;

#[AsSchedule]
class GenerateSitemapScheduler implements ScheduleProviderInterface
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
    )
    {

    }


    public function getSchedule(): Schedule
    {
        $frequency = null;
        if ($this->parameterBag->has('seo.sitemap.frequency')) {
            $frequency = $this->parameterBag->get('seo.sitemap.frequency');
        }

        if (null === $frequency) {
            return new Schedule();
        }

        $schedule = new Schedule();
        $schedule->with(RecurringMessage::every($frequency, new GenerateSitemapMessage()));
        return $schedule;
    }
}