<?php

namespace LanPartyPublisherPhp;

class ModelBase
{
    public function __construct(
        public string|null $name = null,
        public string $apiType = '?',
        public int $apiVersion = 1,
        public string|int|null $siteUniqueId = null,
    ) {
        $this->apiType = get_class($this);
    }
}
