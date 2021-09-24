<?php

namespace App\Application\Service;

use App\Http\Interfaces\Service\IServiceRemove;
use app\Repositories\ServiceRepository;

class ServiceRemove implements IServiceRemove {

    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    function remove($serviceId){
        return $this->serviceRepository->delete($serviceId);
    }
}