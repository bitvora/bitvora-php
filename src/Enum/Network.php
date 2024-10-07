<?php

namespace Bitvora\Enum;

enum Network: string
{
    case MAINNET = 'https://api.bitvora.com';
    case SIGNET = 'https://api.signet.bitvora.com';
}
