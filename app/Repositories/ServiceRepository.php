<?php 

namespace app\Repositories;

use App\Models\Service;
use App\Repositories\AbstractRepository;

class ServiceRepository extends AbstractRepository{

   protected $service;

   public function __construct(Service $service)
   {
       parent::__construct($service);
   }
}