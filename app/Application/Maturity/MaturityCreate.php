<?php

namespace App\Application\Maturity;

use App\Http\Interfaces\Maturity\IMaturityCreate;
use App\Http\Requests\MaturityRequest;
use App\Repositories\MaturityRepository;

class MaturityCreate implements IMaturityCreate{

    private $maturityRepository;

    public function __construct(MaturityRepository $maturityRepository)
    {
        $this->maturityRepository = $maturityRepository;
    }

    function handle(MaturityRequest $request)
    { 
        return $this->maturityRepository->save($request->all());
    }
}