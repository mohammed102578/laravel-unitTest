<?php 

namespace App\Services;

use App\Jobs\SendCompanyRegisteredEmail;


class CompanyService
{
    public function sendRegistrationEmail($email)
    {
        SendCompanyRegisteredEmail::dispatch($email);
    }
}

