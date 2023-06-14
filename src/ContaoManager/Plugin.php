<?php

namespace Guave\SentryBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerBundle\ContaoManagerBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Dependency\DependentPluginInterface;
use Guave\SentryBundle\GuaveSentryBundle;
use Sentry\SentryBundle\SentryBundle;

class Plugin implements BundlePluginInterface, DependentPluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(SentryBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoManagerBundle::class]),

            BundleConfig::create(GuaveSentryBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoManagerBundle::class, SentryBundle::class])
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getPackageDependencies(): array
    {
        return ['sentry/sentry-symfony'];
    }
}
