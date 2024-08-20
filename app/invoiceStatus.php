<?php

namespace App;

enum invoiceStatus: string
{
    case PAID = "paid";

    case UNPAID = "unpaid";
}
