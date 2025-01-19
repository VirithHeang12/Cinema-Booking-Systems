<?php

namespace App\Enums;

enum ShowStatus: string
{
    case SCHEDULED = 'Scheduled';
    case SHOWING = 'Showing';
    case ALREADY = 'Already';
}
