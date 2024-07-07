<?php

namespace App;

enum itemStatus: string
{
    case INSTOCK = 'instock';

    case OUTOFSTOCK = 'outofstock';

    case LIMITED = 'limited';
}
