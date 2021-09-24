<?php

namespace App\Application\Maturity;

use App\Http\Interfaces\Maturity\IMaturityGet;
use app\Repositories\MaturityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaturityGet implements IMaturityGet{

    private $maturityRepository;

    public function __construct(MaturityRepository $maturityRepository)
    {
        $this->maturityRepository = $maturityRepository;
    }

    function allMaturity()
    {
        return $this->maturityRepository->findByColumn('user_id', Auth::user()->id);
    }

    function showMaturity($maturityId)
    {
        return $this->maturityRepository->findUser($maturityId);
    }

    function search(Request $request)
    {
        return $this->maturityRepository->search($request->all());
    }
}