<?php 

namespace App\Http\Interfaces\Maturity;

use App\Http\Requests\MaturityRequest;

interface IMaturityUpdate{
    function update(MaturityRequest $request, $maturityId);
}