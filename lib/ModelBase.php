<?php

namespace LanPartyPublisherPhp;

use ReflectionClass;

class ModelBase
{
    public function __construct(
        public string|null $name = null,
        public string $apiType = '?',
        public int $apiVersion = 1,
        public string|int|null $siteUniqueId = null,
    ) {
        $this->apiType = (new ReflectionClass($this))->getShortName();
    }
}
