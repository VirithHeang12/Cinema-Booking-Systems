<?php

namespace App\Enums;

enum ShowSeatStatus: string
{
    case AVAILABLE = 'Available';
    case BOOKED = 'Booked';
}
