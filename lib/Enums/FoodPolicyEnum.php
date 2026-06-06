<?php

declare(strict_types=1);

namespace LanPartyPublisherPhp\Enums;

enum FoodPolicyEnum: int
{
    case NOT_ARRANGED = 0;
    case NO_OUTSIDE_FOOD = 1;
    case BRING_YOUR_OWN_PERMITTED = 2;
    case FOOD_SOLD_ON_SITE = 4;
    case FREE_FOOD_PROVIDED = 8;
}
