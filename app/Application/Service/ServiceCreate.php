<?php

namespace App\Application\Service;

use App\Http\Interfaces\Service\IServiceCreate;
use App\Http\Requests\ServiceRequest;
use App\Repositories\MaturityRepository;
use App\Repositories\ServiceRepository;
use DateTime;

class serviceCreate implements IServiceCreate
{

    private $serviceRepository;
    private $maturityRepository;
    CONST MONTHS = 12;

    public function __construct(ServiceRepository $serviceRepository, MaturityRepository $maturityRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->maturityRepository = $maturityRepository;
    }

    function handle(ServiceRequest $request)
    {
        $service = $this->serviceRepository->save($request->all());

        if($service['periodic'] == 1 && $service['date_end']){
            $dateInit = new DateTime($service['date_init']);
            $dateEnd = new DateTime($service['date_end']);
            $interval = $dateInit->diff($dateEnd);
            $months = ($interval->y * self::MONTHS) + $interval->m;
            
            for($i = 0; $i <= $months; $i++){
                $data = array();
                $data['service_id'] = $service['id'];
                $data['user_id'] = $service['user_id'];
                $data['status'] = $service['status'];
                $data['date_maturity'] = $i == $months ? $service['date_end'] : date('Y-m-d', strtotime("+ $i months", strtotime($service['date_init'])));
                $this->maturityRepository->insert($data);
            }
        }
        return $service;
    }
}