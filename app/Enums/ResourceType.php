<?php

namespace App\Enums;

enum ResourceType: string
{
    case Stream = 'stream';
    case Tv = 'tv';
    case Theater = 'theater';
}