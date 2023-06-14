<?php

namespace Guave\SentryBundle\Twig;

use Guave\SentryBundle\Helper\TemplateHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigTemplateExtension extends AbstractExtension
{
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return TwigFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('sentry_last_event_id', [TemplateHelper::class, 'sentryLastEventIdFilter']),
            new TwigFilter('sentry_dsn', [TemplateHelper::class, 'sentryDsn']),
        ];
    }
}
