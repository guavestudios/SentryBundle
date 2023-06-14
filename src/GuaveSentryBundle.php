<?php

namespace Guave\SentryBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GuaveSentryBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
