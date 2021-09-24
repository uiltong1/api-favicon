<?php

namespace App\Http\Interfaces\Service;

use App\Http\Requests\ServiceRequest;

interface IserviceUpdate 
{
    function handle(ServiceRequest $request, $id);
}