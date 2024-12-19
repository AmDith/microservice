<?php

namespace App\Enum;

enum EtatDette: string
{
    case ARCHIVER = 'archiver';
    case NONARCHIVER = 'non_archiver';
}
