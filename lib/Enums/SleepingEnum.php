<?php

namespace LanPartyPublisherPhp\Enums;

enum SleepingEnum: int
{
    case NOT_ARRANGED = 0;
    case NOT_OVERNIGHT = 1;
    case PRIVATE_ROOMS = 2;
    case SHARED_ROOM = 3;
    case SHARED_ROOM_AND_CAMPING = 4;
}
