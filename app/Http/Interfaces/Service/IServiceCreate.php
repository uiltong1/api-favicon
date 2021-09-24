<?php

namespace App\Http\Interfaces\Service;

use App\Http\Requests\ServiceRequest;

interface IServiceCreate
{
    function handle(ServiceRequest $request);
}