<?php

namespace App;

enum companyStatus: string
{
    case PENDING = 'pending';

    case REJECTED = 'rejected';
    case APPROVED = 'approved';

    case SUSPENDED = 'suspended';
}
