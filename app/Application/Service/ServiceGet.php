<?php

namespace App\Application\Service;

use App\Http\Interfaces\Service\IServiceGet;
use app\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceGet implements IServiceGet {

    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    function allService()
    {
        return $this->serviceRepository->findByColumn('user_id', Auth::user()->id);
    }

    function showService($serviceId)
    {
        return $this->serviceRepository->findUser($serviceId);
    }

    function search(Request $request)
    {
        return $this->serviceRepository->search($request->all());
    }
}