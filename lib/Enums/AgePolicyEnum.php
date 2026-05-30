<?php

namespace LanPartyPublisherPhp\Enums;

enum AgePolicyEnum: int
{
    case NOT_ARRANGED = 0;
    case GUARDIAN_REQUIRED_FOR_MINORS = 1;
    case MINIMUM_AGE_12 = 2;
    case MINIMUM_AGE_16 = 4;
    case MINIMUM_AGE_18 = 8;
}
