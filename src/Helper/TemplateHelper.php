<?php

namespace Guave\SentryBundle\Helper;

use Sentry\SentrySdk;

class TemplateHelper
{
    public function sentryLastEventIdFilter(): ?string
    {
        return SentrySdk::getCurrentHub()->getLastEventId();
    }

    public function sentryDsn(): ?string
    {
        if ((null !== $client = SentrySdk::getCurrentHub()->getClient())
            && (null !== $dsn = $client->getOptions()->getDsn())) {
            return sprintf(
                '%s://%s@%s/%s',
                $dsn->getScheme(),
                $dsn->getPublicKey(),
                $dsn->getHost(),
                $dsn->getProjectId()
            );
        }

        return null;
    }
}
