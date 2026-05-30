<?php

namespace LanPartyPublisherPhp\Enums;

enum AlcoholPolicyEnum: int
{
    case NOT_ARRANGED = 0;
    case NOT_ALLOWED = 1;
    case BYOB_PERMITTED = 2;
    case SOLD_ON_PREMISES = 4;
    case DESIGNATED_AREA_ONLY = 8;
}
