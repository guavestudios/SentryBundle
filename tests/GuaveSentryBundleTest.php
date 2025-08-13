<?php

declare(strict_types=1);

namespace Guave\SentryBundle\Tests;

use Guave\SentryBundle\GuaveSentryBundle;
use PHPUnit\Framework\TestCase;

class GuaveSentryBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new GuaveSentryBundle();

        $this->assertInstanceOf('Guave\SentryBundle\GuaveSentryBundle', $bundle);
    }
}
