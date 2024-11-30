<?php

namespace LanPartyPublisherPhp;

class ModelBase
{
    public $apiType = '?';
    public $apiVersion = 1;
    public $siteUniqueId = null;
    public $name = null;

    public function __construct($name = null)
    {
        $reflection = new \ReflectionClass($this);
        $this->apiType = $reflection->getShortName();
        $this->name = $name;
    }
}
