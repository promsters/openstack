<?php

declare(strict_types=1);

namespace OpenStack\Common\Transport;

use GuzzleHttp\HandlerStack as GuzzleStack;
use function GuzzleHttp\choose_handler;

class HandlerStack extends GuzzleStack
{
    public static function create(?callable $handler = null): GuzzleStack
    {
        $stack = new self($handler ?: choose_handler());
        $stack->push(Middleware::httpErrors(), 'http_errors');
        $stack->push(Middleware::prepareBody(), 'prepare_body');

        return $stack;
    }
}
