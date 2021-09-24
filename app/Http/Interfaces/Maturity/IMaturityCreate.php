<?php

namespace App\Http\Interfaces\Maturity;

use App\Http\Requests\MaturityRequest;

interface IMaturityCreate{
    function handle(MaturityRequest $maturity);
}