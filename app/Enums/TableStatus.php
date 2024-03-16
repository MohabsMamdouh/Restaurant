<?php

namespace App\Enums;

enum TableStatus: String {
    case Pending = 'pending';
    case Available = 'available';
    case Unavailable = 'unavailable';

}
