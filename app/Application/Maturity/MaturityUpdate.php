<?php

namespace App\Application\Maturity;

use App\Http\Interfaces\Maturity\IMaturityUpdate;
use App\Http\Requests\MaturityRequest;
use app\Repositories\MaturityRepository;

class MaturityUpdate implements IMaturityUpdate
{
    private $maturityRepository;

    public function __construct(MaturityRepository $maturityRepository)
    {
        $this->maturityRepository = $maturityRepository;    
    }

    function update(MaturityRequest $request, $maturityId)
    {
        return $this->maturityRepository->update($maturityId, $request->all());
    }
}