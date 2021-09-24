<?php

namespace App\Http\Interfaces\Service;

use Illuminate\Http\Request;

interface IServiceGet
{    
    function allService();
    function showService($serviceId);
    function search(Request $request);
}