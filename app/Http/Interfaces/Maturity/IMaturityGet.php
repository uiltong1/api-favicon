<?php

namespace App\Http\Interfaces\Maturity;

use Illuminate\Http\Request;

interface IMaturityGet
{
    function allMaturity();
    function showMaturity($maturityId);
    function search(Request $request);
}