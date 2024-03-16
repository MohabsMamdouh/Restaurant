<?php

namespace App\Enums;

enum TableLocation: String {
    case Front = 'front';
    case Inside = 'inside';
    case outside = 'outside';
    case Back = 'back';
}
