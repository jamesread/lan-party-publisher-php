<?php

namespace LanPartyPublisherPhp\Enums;

enum SmokingPolicyEnum: int
{
    case NOT_ARRANGED = 0;
    case NOT_ALLOWED = 1;
    case DESIGNATED_OUTDOOR_AREA = 2;
    case DESIGNATED_INDOOR_AREA = 4;
    case VAPING_PERMITTED = 8;
}
