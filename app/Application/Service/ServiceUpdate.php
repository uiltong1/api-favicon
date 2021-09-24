<?php

namespace App\Application\Service;

use App\Http\Interfaces\Service\IserviceUpdate;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use app\Repositories\ServiceRepository;

class ServiceUpdate implements IserviceUpdate{
    
    private $serviceRepository;
    
    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    function handle(ServiceRequest $request, $id)
    {
        return $this->serviceRepository->update($id, $request->all());   
    }
}