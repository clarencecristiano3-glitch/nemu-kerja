<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case CompanyAdmin = 'company_admin';
    case Superadmin = 'superadmin';
}
