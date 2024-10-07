<?php

namespace Bitvora\Enum;

enum Currency: string
{
    case BTC = 'btc';
    case SATS = 'sats';
    case USD = 'usd';
    case EUR = 'eur';
    case GBP = 'gbp';
    case JPY = 'jpy';
    case CNY = 'cny';
    case CAD = 'cad';
    case AUD = 'aud';
}
