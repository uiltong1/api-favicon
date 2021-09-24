<?php

namespace App\Application\Maturity;

use App\Http\Interfaces\Maturity\IMaturityRemove;
use app\Repositories\MaturityRepository;

class MaturityRemove implements IMaturityRemove
{
    private $maturityRepository;

    public function __construct(MaturityRepository $maturityRepository)
    {
        $this->maturityRepository = $maturityRepository;
    }

    function delete($maturityId)
    {
        return $this->maturityRepository->delete($maturityId);
    }
}